<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Category;
use App\Models\Order;


class EditController extends BaseController
{
    public function __invoke(Order $order)
    {
        $categories = Category::all();
        return view('admin.order.edit', compact('order', 'categories'));
    }
}
