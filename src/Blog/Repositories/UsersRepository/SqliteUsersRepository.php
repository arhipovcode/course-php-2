<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository;

use Mikhailarkhipov\Php2\Blog\Exeptions\UserNotFoundException;
use Mikhailarkhipov\Php2\Blog\User;
use Mikhailarkhipov\Php2\Person\Name;
use Mikhailarkhipov\Php2\Blog\UUID;
use PDO;

class SqliteUsersRepository implements UsersRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user):void
    {
        // Подготавливаем запрос
        $statement = $this->connection->prepare(
            'INSERT INTO users (uuid, username, first_name, last_name) 
                    VALUES (:uuid, :username, :first_name, :last_name)');

        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':uuid' => (string)$user->uuid(),
            ':username' => $user->username(),
            ':first_name' => $user->name()->first(),
            ':last_name' => $user->name()->last()
        ]);
    }

    // Также добавим метод для получения
    // пользователя по его UUID
    public function get(UUID $uuid): User {
        $statement = $this->connection->prepare( 'SELECT * FROM users WHERE uuid = :uuid');
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);

        return $this->getUser($statement, $uuid);
    }

    // Добавили метод получения пользователя по username
    public function getByUsername(string $username): User {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE username = :username'
        );
        $statement->execute([
            ':username' => $username,
        ]);

        return $this->getUser($statement, $username);
    }

    private function getUser(\PDOStatement $statement, string $username): User
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new UserNotFoundException(
                "Cannot find user: $username"
            );
        }

        // Создаём объект пользователя с полем username
        return new User(
            new UUID($result['uuid']),
            new Name($result['first_name'], $result['last_name']),
            $result['username']
        );
    }
}