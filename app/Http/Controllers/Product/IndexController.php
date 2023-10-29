<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\OrderResource;
use App\Models\Product;


class IndexController extends Controller
{
    public function __invoke()
    {
        $products = Product::all();

        return OrderResource::collection($products);
    }
}
