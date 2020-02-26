<?php

namespace App\Http\Controllers;
use App\Events\UserMessage;
use App\Events\AdminMessage;

// use App\Events\SendMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function construct($text){
        // event(new SendMessage($text));
    }

    public function User($text){
        event(new UserMessage($text));
    }

    public function admin($text){
        event(new AdminMessage($text));
    }
}
