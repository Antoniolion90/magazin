<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Order;


class DestroyController extends BaseController
{
    public function __invoke(Order $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
