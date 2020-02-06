<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use ICardRepository;
use Illuminate\Http\Request;
use CardNotFoundException;

class CardController extends Controller
{
    public function index(Request $request, ICardRepository $repository)
    {
        return view('card');
    }

    public function save(Request $request, ICardRepository $repository)
    {
        $rules = ['text' => 'required'];
        $messages = ['text.required' => 'Пустое поле'];
        $this->validate($request, $rules, $messages);
        $card = new \stdClass();
        $card->text = $request->input('text');
        $id = $repository->save($card);
        return redirect('card/' . $id);

    }

    public function getCardById(Request $request, $id, ICardRepository $repository)
    {
        try {
            $card = $repository->findById($id);
        } catch (CardNotFoundException $e) {
            return abort(404);
        }
        return view('addCard',[
            'id' => $id,
            'card' => $card
            ]);
    }
}
