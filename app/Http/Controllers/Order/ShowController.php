<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;


class ShowController extends BaseController
{
    public function __invoke(Order $order)
    {
        return view('order.show', compact('order'));
    }
}
