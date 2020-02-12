<?php

use Illuminate\Support\Facades\DB;

class TranslationNotFoundException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

class TranslationRepository implements ITranslationRepository {

    public function save($translation): int {
        return DB::table('translations')->insertGetId(
                        array('translation' => $translation->translation));
    }

    public function findTranslation(string $translation) {
        $sql = 'select * from translations where translations.translation = ?';
        $bindings = [$translation];
        $translations = DB::select($sql, $bindings);
        if (isset($translations[0])) {
            return $translations[0];
        } else {
            throw new TranslationNotFoundException('Translation ' . $translation . ' not found');
        }
    }

}
