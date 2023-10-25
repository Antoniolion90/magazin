<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;


class DeleteController extends BaseController
{
    public function __invoke(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index');
    }
}
