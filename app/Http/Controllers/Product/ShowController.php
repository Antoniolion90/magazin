<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;


class ShowController extends BaseController
{
    public function __invoke(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }
}
