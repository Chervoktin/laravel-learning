<?php
declare (strict_types = 1);

class Post
{
    private string $text;
    private string $title;
    private int $id;

    public function __construct(string $title, string $text)
    {
        $this->text = $text;
        $this->title = $title;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string{
        return $this->title;
    }
}