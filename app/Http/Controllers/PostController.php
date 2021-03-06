<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use IPostRepository;
use Post;

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
            $posts = $repository->getAllByUserId(Auth::id());
            return view('addPost', ['posts' => $posts]);
        } else {
            return redirect('login');
        }
    }

    public function delete(Request $request, int $id, IPostRepository $repository)
    {
        $repository->deleteByIdAndUserId($id, Auth::id());
        return redirect('blog');
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
            $post = new Post(null, $request->input('title'), $request->input('text'), Auth::id());
            $repository->save($post);
            return redirect('blog');
        } else {
            return redirect('login');
        }
    }
}
