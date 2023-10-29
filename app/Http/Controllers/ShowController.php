<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        return view('show', compact('product'));
    }
}
