<?php

namespace Mikhailarkhipov\Php2\Blog;

use Mikhailarkhipov\Php2\Person\Name;
use Mikhailarkhipov\Php2\Blog\UUID;

class User
{
    protected UUID $uuid;
    protected Name $name;
    protected string $username;

    public function __construct(UUID $uuid, Name $name, string $username)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->username = $username;
    }

    public function __toString(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function uuid(): UUID
    {
        return $this->uuid;
    }

    public function username(): string
    {
        return $this->username;
    }
}