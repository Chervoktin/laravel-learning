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

interface IPostRepository
{
    public function findById(int $id): Post;
    public function getAll(): array;
    public function save(Post $post): void;
}

class ArrayRepository implements IPostRepository
{
    public function findById(int $id): Post
    {
        $post = new Post("id", "post with id: " . (string) $id);
        return $post;
    }

    public function getAll(): array
    {
        $posts = array();
        for($i = 1 ; $i <= 10; $i++){
            $post = new Post('Title ' . $i , "post with id: " . (string) $i);
            $post->setId($i);
            $posts[$i] =  $post;
        }
        return $posts;
    }

    public function save(Post $post):void{
        dd('save post with text: ' . $post->getText());
    }
}
