<?php
declare (strict_types = 1);

interface IPostRepository
{
    public function findById(int $id): Post;
    public function getAllByUserId(int $id): array;
    public function save(Post $post): void;
    public function deleteByIdAndUserId(int $id, int $user_id): void;
}
