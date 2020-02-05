<?php
declare (strict_types = 1);

class Post
{
    private string $text;
    private string $title;
    private int $id;
    private int $user_id;

    public function __construct(?int $id, string $title, string $text, int $user_id)
    {
        if($id != null){
            $this->id = $id;
        }
        $this->text = $text;
        $this->title = $title;
        $this->user_id = $user_id;
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
    
    public function getUserId(): int{
        return $this->user_id;
    }
}