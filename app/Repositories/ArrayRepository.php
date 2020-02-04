<?php
declare (strict_types = 1);


class Post
{
    private $text;
    private $id;

    public function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
    public function getText(): string
    {
        return $text;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $id;
    }
}

interface IPostRepository
{
    public function getById(int $id);
}

class ArrayRepository implements IPostRepository
{
    public function getById(int $id)
    {
        return $id;
    }
}
