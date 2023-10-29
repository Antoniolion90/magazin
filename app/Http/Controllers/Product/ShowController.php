<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

use App\Http\Resources\Product\OrderResource;
use App\Models\Product;


class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        return new OrderResource($product);
    }
}
