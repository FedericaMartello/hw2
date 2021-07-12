<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use Request;
use User;
use Hash;

class LoginController extends BaseController
{
    public function login()
    {
        //Verifichiamo se l'utente ha già fatto il login
        if(session('user_id') != null)
        {
            //Redirect alla home
            return redirect('home');
        }
        else
        {
            //Verifichiamo se c'è stato un errore nel login
            $old_username = Request::old('username');
            return view('login')->with('csrf_token', csrf_token())->with('old_username', $old_username);
        }
    }

    public function checkLogin()
    {
        //Verifichiamo che l'utente esista
        $password=request('password');
        $hashed=Hash::make(request('password'));
        $user = User::where('username', request('username'))->where('password', Hash::check($hashed, $password))->first();

        if(isset($user))
        {
            //Credenziali valide
            Session::put('user_id', $user->id);
            return redirect('home');
        }
        else
        {
            //Credenziali non valide
            return redirect('login')->withInput();
        }
    }

    public function logout()
    {
        //Eliminiamo i dati di sessione
        Session::flush();
        //Torniamo al login
        return redirect('login');
    }
}


?>