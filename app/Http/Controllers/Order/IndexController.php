<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;


class IndexController extends Controller
{
    public function __invoke()
    {
        $orders = Order::all();

        return OrderResource::collection($orders);
    }
}
