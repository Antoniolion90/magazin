<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;

use App\Http\Resources\Order\OrderResource;
use App\Models\Order;


class ShowController extends Controller
{
    public function __invoke(Order $rder)
    {
        return new OrderResource($order);
    }
}
