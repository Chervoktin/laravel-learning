<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CardNotFoundException;
use WordNotFoundException;
use TranslationNotFoundException;
use ICardRepository;
use Illuminate\Http\Request;
use IWordRepository;
use ITranslationRepository;
use Illuminate\Support\Facades\DB;

class CardController extends Controller {

    private ICardRepository $_cardRepository;
    private ITranslationRepository $_translationRepository;
    private IWordRepository $_wordRepository;

    public function __construct(
            ICardRepository $cardRepository,
            ITranslationRepository $translationRepository,
            IWordRepository $wordRepository) {
        $this->_cardRepository = $cardRepository;
        $this->_translationRepository = $translationRepository;
        $this->_wordRepository = $wordRepository;
    }

    public function index(Request $request) {
        return view('card');
    }

    public function save(Request $request) {
        $rules = ['text' => 'required'];
        $messages = ['text.required' => 'Пустое поле'];
        $this->validate($request, $rules, $messages);
        $card = new \stdClass();
        $card->text = $request->input('text');
        $id = $this->_cardRepository->save($card);
        return redirect('card/' . $id);
    }

    public function addWordWithTranslation(Request $request, int $card_id) {
        $rules = ['word' => 'required',
            'translation' => 'required'
        ];
        $messages = [
            'word.required' => 'Пустое поле',
            'translation.required' => 'Пустое поле'
        ];
        $this->validate($request, $rules, $messages);

        if ($this->_wordRepository->isExistsByWordInCards($request->input('word'), $card_id)) {
            dd("already exist");
        } else {
            try {
                $word = $this->_wordRepository->findWord($request->input('word'));
                $word_id = $word->id;
            } catch (WordNotFoundException $e) {
                $word = new \stdClass();
                $word->word = $request->input('word');
                $word_id = $this->_wordRepository->save($word);
            }

            try {
                $translation = $this->_translationRepository->findTranslation($request->input('translation'));
                $translation_id = $translation->id;
            } catch (TranslationNotFoundException $e) {
                $translation = new \stdClass();
                $translation->translation = $request->input('translation');
                $translation_id = $this->_translationRepository->save($translation);
            }

            $word_with_translation_id = $this->_wordRepository->addTranslationById($word_id, $translation_id);
            $this->_cardRepository->addWordWithTranslation($card_id, $word_with_translation_id);
        }
        return redirect('/card/' . (string) $card_id);
    }

    public function getCardById(Request $request, int $card_id) {
        try {
            $card = $this->_cardRepository->findById($card_id);
            $words = $this->_wordRepository->findAllByCardId($card_id);
        } catch (CardNotFoundException $e) {
            return abort(404);
        }
        return view('addCard', [
            'id' => $card_id,
            'card' => $card,
            'words' => $words,
        ]);
    }

    public function deleteWord(Request $request,
            int $card_id,
            int $cards_with_words_id) {
        $this->_wordRepository->deleteWordFormCardByCardsWithWordsWithTranslationsId($cards_with_words_id);
        return redirect('/card/' . (string) $card_id);
    }

    public function getAllCards(Request $request) {
        return DB::select('select id, text from cards');
    }

    public function getAllWords(Request $request, int $card_id) {
        return $this->_wordRepository->findAllByCardId($card_id);
    }

    public function increment(Request $request, int $id) {
        $sql = "select scores from words_with_translations where id = ?";
        $bindings = [$id];
        $scores = (int) DB::select($sql, $bindings)[0]->scores;

        $sql = "UPDATE words_with_translations SET scores = ? where id = ?";
        $scores += 1;
        $bindings = [$scores, $id];
        DB::update($sql, $bindings);
        return $scores;
    }

    public function incrementCard(Request $request, int $id) {
        $sql = "select scores from cards where id = ?";
        $bindings = [$id];
        $scores = (int) DB::select($sql, $bindings)[0]->scores;

        $sql = "UPDATE cards SET scores = ? where id = ? ";
        $scores += 1;
        $bindings = [$scores, $id];
        DB::update($sql, $bindings);
        return $scores;
    }

    public function decrementCard(Request $request, int $id) {
        $sql = "select scores from cards where id = ?";
        $bindings = [$id];
        $scores = (int) DB::select($sql, $bindings)[0]->scores;

        $sql = "UPDATE cards SET scores = ? where id = ? ";
        $scores -= 1;
        $bindings = [$scores, $id];
        DB::update($sql, $bindings);
        return $scores;
    }

    public function decrement(Request $request, int $id) {
        $sql = "select scores from words_with_translations where id = ?";
        $bindings = [$id];
        $scores = (int) DB::select($sql, $bindings)[0]->scores;

        $sql = "UPDATE words_with_translations SET scores = ? where id = ? ";
        $scores -= 1;
        $bindings = [$scores, $id];
        DB::update($sql, $bindings);
        return $scores;
    }

    public function test(Request $request) {
        return view('test');
    }

}
