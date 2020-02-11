<?php

interface IWordRepository {

    public function save($word);

    public function findById($id);

    public function isExistsById(int $id): bool;

    public function isExistsByWordInCards(string $word, int $card_id): bool;

    public function addTranslationById($word_id, $translation_id): int;

    public function findAllByCardId(int $card_id);

    public function deleteWordFormCardByCardsWithWordsWithTranslationsId(int $cards_with_words_with_translations_id);
}
