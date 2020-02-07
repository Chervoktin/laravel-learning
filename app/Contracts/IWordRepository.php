<?php

interface IWordRepository {

    public function save($word);

    public function findById($id);

    public function isExistsById(int $id): bool;
    
    public function isExistsByWord(string $word): bool;
}
