<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Requests\Admin\Order\SroreRequest;


class StoreController extends BaseController
{
    public function __invoke(SroreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('admin.order.index');
    }
}
