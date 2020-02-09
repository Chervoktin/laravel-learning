<?php

interface ICardRepository {

    public function save($card);

    public function findById($id);

    public function addWordWithTranslation($card_id, $word_with_translation_id);
}
