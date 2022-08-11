<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\CommentsRepository;

use Mikhailarkhipov\Php2\Blog\Comment;
use Mikhailarkhipov\Php2\Blog\Exeptions\InvalidArgumentException;
use Mikhailarkhipov\Php2\Blog\Exeptions\PostsNotFoundExeption;
use PDO;
use Mikhailarkhipov\Php2\Blog\UUID;

class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Comment $comment):void
    {
        // Подготавливаем запрос
        $statement = $this->connection->prepare(
            'INSERT INTO comments (uuid, post_uuid, author_uuid, text) 
                    VALUES (:uuid, :post_uuid, :author_uuid, :text)');

        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':uuid' => $comment->getUuid(),
            ':post_uuid' => $comment->getPostUuid(),
            ':author_uuid' => $comment->getAuthorUuid(),
            ':text' => $comment->getText()
        ]);
    }

    /**
     * @throws PostsNotFoundExeption|InvalidArgumentException
     */
    public function get(UUID $uuid): Comment {
        $statement = $this->connection->prepare( 'SELECT * FROM comments WHERE uuid = :uuid');
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);

        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws PostsNotFoundExeption|InvalidArgumentException
     */
    private function getPost(\PDOStatement $statement, string $uuid): Comment
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PostsNotFoundExeption(
                "Cannot find comment uuid: $uuid"
            );
        }

        return new Comment(
            new UUID($result['uuid']),
            new UUID($result['post_uuid']),
            new UUID($result['author_uuid']),
            $result['text']
        );
    }
}