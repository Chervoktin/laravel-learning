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

    public function isExistsById(int $id): bool {
        return (bool)DB::select('select id from words where id = ?', [$id])[0];
    }
    
     public function isExistsByWord(string $word): bool {
        return (bool)DB::select('select id from words where word = ?', [$word])[0];
    }
}
