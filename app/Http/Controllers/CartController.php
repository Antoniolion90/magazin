<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function __invoke(Product $product)
    {
        return view('cart');
    }
}
