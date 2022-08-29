<?php

namespace Mikhailarkhipov\Php2\UnitTests\Repositories;

use Mikhailarkhipov\Php2\Blog\Exeptions\UserNotFoundException;
use Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

//class SqliteUsersRepositoryTest extends TestCase
//{
//    // Тест, проверяющий, что SQLite-репозиторий бросает исключение,
//    // когда запрашиваемый пользователь не найден
//    public function testItThrowsAnExceptionWhenUserNotFound(): void
//    {
//        // Сначала нам нужно подготовить все стабы
//        // 2. Создаём стаб подключения
//        $connectionStub = $this->createStub(PDO::class);
//        // 4. Стаб запроса
//        $statementStub = $this->createStub(PDOStatement::class);
//        // 5. Стаб запроса будет возвращать false
//        // при вызове метода fetch
//        $statementStub->method('fetch')->willReturn(false);
//        // 3. Стаб подключения будет возвращать другой стаб -
//        // стаб запроса - при вызове метода prepare
//        $connectionStub->method('prepare')->willReturn($statementMock);
//
//        // 1. Передаём в репозиторий стаб подключения
//        $repository = new SqliteUsersRepository($connectionStub);
//        // Ожидаем, что будет брошено исключение
//        $this->expectException(UserNotFoundException::class);
//        $this->expectExceptionMessage('Cannot find user: Ivan');
//        // Вызываем метод получения пользователя
//        $repository->getByUsername('Ivan');
//    }
//}