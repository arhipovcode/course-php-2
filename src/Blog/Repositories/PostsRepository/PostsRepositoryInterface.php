<?php

namespace Mikhailarkhipov\Php2\Blog\Repositories\PostsRepository;

use Mikhailarkhipov\Php2\Blog\Post;
use Mikhailarkhipov\Php2\Blog\UUID;

interface PostsRepositoryInterface
{
    public function save(Post $user): void;
    public function get(UUID $uuid): Post;
}