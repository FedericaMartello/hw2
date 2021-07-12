<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use User;
use Http;

class FotoController extends BaseController
{
    public function index()
    {
        $user = User::find(session('user_id'));
        if(isset($user))
        {
            return view('foto')->with("user", $user);
        }
        else
        {
            return redirect('login');
        }
    }
    
    public function unsplash($query)
    {
        $json = Http::get('https://api.unsplash.com/search/photos', [
            'per_page' => 12,
            'orientation' => 'landscape',
            'client_id' => env('UNSPLASH_APIKEY'),
            'query' => $query,
        ]);
        
        if ($json->failed()) abort(500);

        $newJson = array();
        for ($i = 0; $i < count($json['results']); $i++)
        {
            $newJson[] = array(
            'preview' => $json['results'][$i]['urls']['regular']
            );
        }

        return response()->json($newJson);
           
    }
    
        
}


?>