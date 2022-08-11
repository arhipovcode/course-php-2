<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository;

use Mikhailarkhipov\Php2\Blog\Exeptions\UserNotFoundException;
use Mikhailarkhipov\Php2\Blog\User;
use Mikhailarkhipov\Php2\Blog\UUID;

class InMemoryUsersRepository implements UsersRepositoryInterface
{

    private array $users = [];


    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    public function get(UUID $uuid): User
    {
        foreach ($this->users as $user) {
            // Сравниваем строковые представления UUID
            if ((string)$user->uuid() === (string)$uuid) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $uuid");
    }


    public function getByUsername(string $username): User
    {
        foreach ($this->users as $user) {
            if ($user->username() === $username) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $username");
    }

}