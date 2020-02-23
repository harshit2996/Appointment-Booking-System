<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\User;

class AdminController extends Controller
{
    public function construct(){
        return view('admin.default');
    }

    public function index(){
        
        return UserResource::collection(User::select()->where('isAdmin',0)->get());
        // dd(User::select()->where('isAdmin',0)->get());

    }

    public function show($request){
        return view('admin.events');
    }
    
    public function events($request){
        // dd($request);
        return view('admin.events');
    }

}
