<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function signin()
    {
        return view('users.signin');
    }
    public  function login()
    {
        return view('users.login');
    }
    public function activate(Request $request)
    {
        $formFields = $request ->validate([
            'email'=>['required','email'],
            'car_seat'=>['required'],
            'password'=>'required'|'confirmed'|'min:8'
        ]);

        // acronyme exist?
        $user = User::firstWhere('acronym', $request->username);
        if ($user) {
            $user->active = true;
            $user->password = bcrypt($formFields['password']);
            $user->save();

        } else {
            return back()->withErrors(['email'=>'erreur de dans l\'un des champs'])->onlyInput('email');
        }



    }
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    public function log(Request $request)
    {
        $formFields = $request ->validate([
            'username'=>['required'],
            'password'=>'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/');

        }
        return back()->withErrors(['email'=>'erreur de dans l\'un des champs'])->onlyInput('email');


    }
}

