<?php

use Illuminate\Support\Facades\DB;

class WordNotFoundException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

class WordRepository implements IWordRepository {

    public function save($word): int {
        return DB::table('words')->insertGetId(
                        array('word' => $word->word)
        );
    }

    public function findById($id) {
        
    }
    
    public function findAllByCardId(int $card_id){
        $sql = 'select words_with_translations.id, words.word, translations.translation from cards
                inner join cards_with_words_with_translations
                on cards.id = cards_with_words_with_translations.card_id
                inner join words_with_translations
                on cards_with_words_with_translations.words_with_translations_id = words_with_translations.id
                inner join words
                on words_with_translations.word_id = words.id
				inner join translations
				on words_with_translations.translation_id = translations.id
                where cards.id = ?';
        return DB::select($sql, [$card_id]);
    }

    public function isExistsById(int $id): bool {
        return (bool) DB::select('select id from words where id = ?', [$id])[0];
    }

    public function isExistsByWordInCards(string $word, int $card_id): bool {
        $sql = 'select words.id from cards
                inner join cards_with_words_with_translations
                on cards.id = cards_with_words_with_translations.card_id
                inner join words_with_translations
                on cards_with_words_with_translations.words_with_translations_id = words_with_translations.id
                inner join words
                on words_with_translations.word_id = words.id
                where (words.word = ?)
                and (cards.id = ?)';
        $results = DB::select($sql, [$word, $card_id]);
        if (isset($results[0])) {
            return true;
        } else {
            return false;
        }
    }

    public function AddTranslationById($word_id, $translation_id): int {
        $values = array('word_id' => $word_id,
            'translation_id' => $translation_id
        );
        return DB::table('words_with_translations')->insertGetId($values);
    }

}
