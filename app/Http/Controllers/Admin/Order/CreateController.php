<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Category;


class CreateController extends BaseController
{
    public function __invoke()
    {
        $categories = Category::all();
        return view('admin.order.create', compact('categories'));
    }
}
