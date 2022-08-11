<?php

namespace Mikhailarkhipov\Php2\Blog;

use Mikhailarkhipov\Php2\Blog\UUID;

class Comment extends \Mikhailarkhipov\Php2\Blog\Post
{
    private UUID $uuid;
    private UUID $post_uuid;
    private UUID $author_uuid;
    private string $text;

    public function __construct(
        UUID $uuid,
        UUID $post_uuid,
        UUID $author_uuid,
        string $text)
    {
        $this->uuid = $uuid;
        $this->post_uuid = $uuid;
        $this->author_uuid = $uuid;
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->author_uuid . ' пишет: ' . $this->text;
    }

    /**
     * @return UUID
     */
    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    /**
     * @return UUID
     */
    public function getAuthorUuid(): UUID
    {
        return $this->author_uuid;
    }

    /**
     * @return UUID
     */
    public function getPostUuid(): UUID
    {
        return $this->post_uuid;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}