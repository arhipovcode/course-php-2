<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\CommentsRepository;

use Mikhailarkhipov\Php2\Blog\Comment;
use Mikhailarkhipov\Php2\Blog\UUID;

interface CommentsRepositoryInterface
{
    public function save(Comment $user): void;
    public function get(UUID $uuid): Comment;
}