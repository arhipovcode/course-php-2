<?php

namespace Mikhailarkhipov\Php2\Comments;

use Mikhailarkhipov\Php2\Users\User;
use Mikhailarkhipov\Php2\Articles\Article;

class Comment
{
    public int $idComment;
    public User $idUser;
    public Article $idArticle;
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