<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use User;
use Http;

class RecipesController extends BaseController
{
    public function index()
    {
        $user = User::find(session('user_id'));
        if(isset($user))
        {
            return view('recipes')->with("user", $user);
        }
        else
        {
            return redirect('login');
        }
    }
    
    public function spoonacular($query)
    {
        $link = base64_decode($query);

        $json = Http::get('https://api.spoonacular.com/recipes/extract', [
            'url' => $link,
            'apiKey' => env('SPOONACULAR_APIKEY')
        ]);
        
        if ($json->failed()) abort(500);

        $newJson = array();
        $newJson[] = array('nome' => $json['title'], 'foto' => $json['image'], 'ingredienti' => $json['extendedIngredients'], 'istruzioni' => $json['instructions']);

        return response()->json($newJson);
                   
    }
    
        
}


?>