<?php

namespace Mikhailarkhipov\Php2\Blog\Commands;

use Mikhailarkhipov\Php2\Blog\Exeptions\UserNotFoundException;
use Mikhailarkhipov\Php2\Blog\Exeptions\CommandException;
use Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use Mikhailarkhipov\Php2\Person\Name;
use Mikhailarkhipov\Php2\Blog\User;
use Mikhailarkhipov\Php2\Blog\UUID;

class CreateUserCommand
{
    private UsersRepositoryInterface $usersRepository;

    // Команда зависит от контракта репозитория пользователей, // а не от конкретной реализации
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function handle(Arguments $arguments): void
    {
        $username = $arguments->get('username');

        // Проверяем, существует ли пользователь в репозитории
        if ($this->userExists($username)) {
            // Бросаем исключение, если пользователь уже существует
            throw new CommandException("User already exists: $username");
        }

        // Сохраняем пользователя в репозиторий
        $this->usersRepository->save(new User(
            UUID::random(),
            new Name($arguments->get('first_name'), $arguments->get('last_name')),
            $username
        ));
    }

    private function userExists(string $username): bool
    {
        try {
            // Пытаемся получить пользователя из репозитория
            $this->usersRepository->getByUsername($username);
        } catch (UserNotFoundException $ex) {
            return false;
        }
        return true;
    }
}