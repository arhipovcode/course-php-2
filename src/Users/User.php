<?php

namespace Mikhailarkhipov\Php2\Users;

class User
{
    public int $id;
    public string $name;
    public string $surname;

    public function __construct(int $id, string $name, string $surname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function __toString(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}