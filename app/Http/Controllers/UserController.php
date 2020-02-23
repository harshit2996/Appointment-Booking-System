<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function construct($name){
        // dd($name);
        return view('user.home')->with(['name' => $name]);
    }
}
