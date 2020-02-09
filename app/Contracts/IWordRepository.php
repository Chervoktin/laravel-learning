<?php

interface IWordRepository {

    public function save($word);

    public function findById($id);

    public function isExistsById(int $id): bool;

    public function isExistsByWordInCards(string $word, int $card_id): bool;

    public function AddTranslationById($word_id, $translation_id): int;
}
