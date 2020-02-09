<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CardNotFoundException;
use ICardRepository;
use Illuminate\Http\Request;
use WordRepository;
use TranslationRepository;
use IWordRepository;
use ITranslationRepository;

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
            $word = new \stdClass();
            $word->word = $request->input('word');
            $word_id = $this->_wordRepository->save($word);

            $translation = new \stdClass();
            $translation->translation = $request->input('translation');
            $translation_id = $this->_translationRepository->save($translation);

            $word_with_translation_id = $this->_wordRepository->AddTranslationById($word_id, $translation_id);
            $this->_cardRepository->addWordWithTranslation($card_id, $word_with_translation_id);
        }
        return redirect('/card/' . (string) $card_id);
    }

    public function getCardById(Request $request, $id) {
        try {
            $card = $this->_cardRepository->findById($id);
        } catch (CardNotFoundException $e) {
            return abort(404);
        }
        return view('addCard', [
            'id' => $id,
            'card' => $card,
        ]);
    }

}
