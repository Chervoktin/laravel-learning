<?php
declare (strict_types = 1);
use Illuminate\Support\Facades\DB;


class PostRepository implements IPostRepository
{
    public function findById(int $id): Post
    {
        $post = new Post("id", "post with id: " . (string) $id, $id);
        return $post;
    }

    public function getAll(): array
    {
        $posts = DB::select('select * from posts',[]);
        $postsArray = array();
        foreach($posts as $post){
           
            $postItem = new Post((int)$post->id, $post->title, $post->text, (int)$post->user_id);
            array_push($postsArray, $postItem);
        }
        return $postsArray;
    }

    public function save(Post $post):void{
        $context = [
            $post->getTitle(), 
            $post->getText(),
            $post->getUserId()];
        DB::insert('insert into posts (title, text, user_id) values (? ,? ,?)',$context);
    }
}
