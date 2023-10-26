<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;


class DeleteController extends BaseController
{
    public function __invoke(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
