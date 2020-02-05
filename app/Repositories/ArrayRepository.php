<?php
declare (strict_types = 1);

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
