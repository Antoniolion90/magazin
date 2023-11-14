<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Order\SroreRequest;


class StoreController extends BaseController
{
    public function __invoke(SroreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('main.index');
    }
}
