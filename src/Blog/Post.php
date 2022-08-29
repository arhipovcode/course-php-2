<?php

namespace Mikhailarkhipov\Php2\Blog;

class Post
{
    private UUID $uuid;
    private UUID $author_uuid;
    private string $title;
    private string $text;

    public function __construct(
        UUID $uuid,
        UUID $author_uuid,
        string $title,
        string $text)
    {
        $this->uuid = $uuid;
        $this->author_uuid = $uuid;
        $this->title = $title;
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->author_uuid . ' пишет: ' . $this->text;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function getAuthorUuid(): UUID
    {
        return $this->author_uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }
}