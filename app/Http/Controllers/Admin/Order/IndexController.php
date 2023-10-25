<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Filters\OrderFilter;
use App\Http\Requests\Admin\Order\FilterRequest;
use App\Models\Order;


class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(OrderFilter::class, ['queryParams' => array_filter($data)]);

        $orders = Order::filter($filter)->paginate(10);

        return view('admin.order.index', compact('orders'));
    }
}
