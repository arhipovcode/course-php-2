<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository;

use Mikhailarkhipov\Php2\Blog\Exeptions\UserNotFoundException;
use Mikhailarkhipov\Php2\Blog\User;
use Mikhailarkhipov\Php2\Blog\UUID;
use Mikhailarkhipov\Php2\Person\Name;

// Dummy - чучуло, манекен
class DummyUsersRepository implements UsersRepositoryInterface
{

    public function save(User $user): void
    {
        // Ничего не делаем
    }

    public function get(UUID $uuid): User
    {
        // И здесь ничего не делаем
        throw new UserNotFoundException("Not found");
    }

    public function getByUsername(string $username): User
    {
        // Нас интересует реализация только этого метода
        // Для нашего теста не важно, что это будет за пользователь,
        // поэтому возвращаем совершенно произвольного
        return new User(UUID::random(), new Name("first", "last"), 'user123');
    }
}