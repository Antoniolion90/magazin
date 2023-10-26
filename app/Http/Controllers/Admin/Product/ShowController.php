<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;


class ShowController extends BaseController
{
    public function __invoke(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }
}
