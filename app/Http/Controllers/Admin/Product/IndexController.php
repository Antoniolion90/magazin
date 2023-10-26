<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\Admin\Product\FilterRequest;
use App\Models\Product;


class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->paginate(10);

        return view('admin.product.index', compact('products'));
    }
}
