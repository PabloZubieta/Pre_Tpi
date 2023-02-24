<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function signin(){
        return view('users.signin');
    }
    public  function login(){
        return view('users.login');
    }
    public function activate(Request $request){
        $formFields = $request ->validate([
            'email'=>'required',


            ]

        );
    }
}
