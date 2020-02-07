<?php
use Illuminate\Support\Facades\DB;

class TranslationRepository implements ITranslationRepository {

    public function save($translation): int {
        return DB::table('translations')->insertGetId(
                        array('translation' => $translation->translation));
    }

}