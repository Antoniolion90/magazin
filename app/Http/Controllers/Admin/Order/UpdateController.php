<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;


class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        $order = $this->service->update($order, $data);

        return redirect()->route('admin.order.show', compact('order'));
    }
}
