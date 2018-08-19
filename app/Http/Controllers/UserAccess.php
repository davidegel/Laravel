<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FriendFormRequest;
use Auth;

class UserAccess extends Controller {
    
    public function login()
    {
        return view('login.form');
    }

    public function access(FriendFormRequest $request)
    {
        $data = $request->only('email','password');
        if(Auth::attempt($data)) {
            return redirect()->intended('privata');
        }else {
            return redirect()->intended('utente/login');
        }
    }
    
    /*
    public function formContatti(Request $request)
    {
        $data = $request->only('email','password');
        if(Auth::attempt($data)) {
            return redirect()->intended('privata');
        }else {
            return redirect()->intended('utente/login');
        }
    }
   */

}

