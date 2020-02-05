<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use IPostRepository;

class PostController extends Controller
{

    public function messages()
    {
        return [
            'text.required' => 'Необходимо заполнить поле',
        ];
    }

    public function add(Request $request, IPostRepository $repository)
    {
        if (Auth::check()) {
            $posts = $repository->getAll();
            return view('addPost', ['posts' => $posts]);
        } else {
            return redirect('login');
        }
    }

    public function addComplite(Request $request, IPostRepository $repository)
    {
        if (Auth::check()) {
            $rules = [
                'text' => 'max:255|required',
                'title' => 'required|max:50',
            ];
            $messages = [
                'text.required' => 'Необходимо заполнить текст',
                'title.required' => 'Необходимо заполнить заголовок',
            ];
            $this->validate($request, $rules, $messages);
            $post = new Post($request->input('title'), $request->input('text'));
            $repository->save($post);
            return redirect('blog');
        } else {
            return redirect('login');
        }
    }
}
