<?php

declare (strict_types=1);

use Illuminate\Support\Facades\DB;

class CardNotFoundException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

class CardRepository implements ICardRepository {

    public function save($card) {
        return DB::table('cards')->insertGetId(
                        array('text' => $card->text)
        );
    }

    public function findById($id) {
        $arr = DB::select('select * from cards where id = ?', [$id]);
        if (isset($arr[0])) {
            return $arr[0];
        } else {
            throw new CardNotFoundException("card with id: " . $id . " not found");
        }
    }

}
