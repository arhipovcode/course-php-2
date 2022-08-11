<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\PostsRepository;

use Mikhailarkhipov\Php2\Blog\Exeptions\InvalidArgumentException;
use Mikhailarkhipov\Php2\Blog\Exeptions\PostsNotFoundExeption;
use Mikhailarkhipov\Php2\Blog\Post;
use Mikhailarkhipov\Php2\Blog\UUID;
use PDO;

class SqlitePostsRepository implements PostsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Post $post):void
    {
        // Подготавливаем запрос
        $statement = $this->connection->prepare(
            'INSERT INTO posts (uuid, author_uuid, title, text) 
                    VALUES (:uuid, :author_uuid, :title, :text)');

        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':uuid' => $post->getUuid(),
            ':author_uuid' => $post->getAuthorUuid(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText()
        ]);
    }

    /**
     * @throws PostsNotFoundExeption
     * @throws InvalidArgumentException
     */
    public function get(UUID $uuid): Post {
        $statement = $this->connection->prepare( 'SELECT * FROM posts WHERE uuid = :uuid');
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);

        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws PostsNotFoundExeption
     * @throws InvalidArgumentException
     */
    private function getPost(\PDOStatement $statement, string $uuid): Post
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PostsNotFoundExeption(
                "Cannot find post uuid: $uuid"
            );
        }

        return new Post(
            new UUID($result['uuid']),
            new UUID($result['author_uuid']),
            $result['title'],
            $result['text']
        );
    }
}