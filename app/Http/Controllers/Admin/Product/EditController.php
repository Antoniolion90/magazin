<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Category;
use App\Models\Product;


class EditController extends BaseController
{
    public function __invoke(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }
}
