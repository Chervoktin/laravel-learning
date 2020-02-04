<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers \Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function show(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);
        return view('profile', ['name' => $request->input('name')]);
    }
}