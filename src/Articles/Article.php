<?php

namespace Mikhailarkhipov\Php2\Articles;

use Mikhailarkhipov\Php2\Users\User;

class Article
{
    public int $idArticle;
    public User $idUser;
    public string $title;
    public string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->text;
    }
}