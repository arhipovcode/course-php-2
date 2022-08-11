<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\UsersRepository;

use Mikhailarkhipov\Php2\Blog\User;
use Mikhailarkhipov\Php2\Blog\UUID;

interface UsersRepositoryInterface
{
    public function save(User $user): void;
    public function get(UUID $uuid): User;
    public function getByUsername(string $username): User;
}