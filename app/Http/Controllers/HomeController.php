<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use User;

class HomeController extends BaseController
{
    public function home()
    {
        //Leggiamo l'utente connesso
        $user = User::find(session('user_id'));
        if(!isset($user))
        {
            return redirect('login');
        }
        else
        {
            return view('home');
        }
    }
}


?>