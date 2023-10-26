<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests\Admin\Product\SroreRequest;


class StoreController extends BaseController
{
    public function __invoke(SroreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('admin.product.index');
    }
}
