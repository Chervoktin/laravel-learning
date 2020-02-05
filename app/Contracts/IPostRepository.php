<?php
declare (strict_types = 1);

interface IPostRepository
{
    public function findById(int $id): Post;
    public function getAll(): array;
    public function save(Post $post): void;
}