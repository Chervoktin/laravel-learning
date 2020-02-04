<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ Controller;
use Illuminate\Http\Request;
use ArrayRepository;
use IPostRepository;

class UserController extends Controller
{

    public function show(Request $request, IPostRepository $repository)
    {
        
        return $repository->getById(2);

    }
}
