<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use User;
use App\Models\Ingredients;
use App\Models\Product;

class IngredientsController extends BaseController
{

    public function index()
    {
        $user = User::find(session('user_id'));
        if(isset($user))
        {
            return view('ingredients')->with("user", $user);
        }
        else
        {
            return redirect('login');
        }
    }

    public function AllIngredients()
    {
        $ingredienti = Ingredients::all();

        return $ingredienti;
    }

    public function WhatInside_1($i1)
    {
        $prodotti = Ingredients::find($i1)->inside()->get();

        return $prodotti;
    }

    public function WhatInside_2($i1, $i2)
    { 
        $p1 = Ingredients::find($i1)->inside()->get();
        $p2 = Ingredients::find($i2)->inside()->get();

        
        $result = array();
        for($i=0; $i<count($p1); $i++)
        {
            for($j=0; $j<count($p2); $j++)
            {
                if($p1[$i]->id === $p2[$j]->id)
                {
                    $result[] = $p1[$i];
                }
            }
        }

        return $result;

    }

    public function WhatInside_3($i1, $i2, $i3)
    {
        $p1 = Ingredients::find($i1)->inside()->get();
        $p2 = Ingredients::find($i2)->inside()->get();
        $p3 = Ingredients::find($i3)->inside()->get();

        
        $result = array();
        for($i=0; $i<count($p1); $i++)
        {
            for($j=0; $j<count($p2); $j++)
            {
                for($k=0; $k<count($p3); $k++)
                {
                    if($p1[$i]->id === $p2[$j]->id &&  $p1[$i]->id === $p3[$k]->id)
                    {
                        $result[] = $p1[$i];
                    }
                }
            }
        }

        return $result;
    }

}


?>