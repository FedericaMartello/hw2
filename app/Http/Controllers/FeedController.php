<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;

class FeedController extends BaseController
{
    public function feed()
    {
        $products = Product::all();

        return $products;
    }
}

?>