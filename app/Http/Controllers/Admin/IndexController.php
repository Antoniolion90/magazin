<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\OrderFilter;
use App\Http\Requests\Admin\Order\FilterRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;


class IndexController extends Controller
{
    public function __invoke()
    {
        $data = [];

        $data['clientsCount'] = Client::all()->count();
        $data['categoriesCount'] = Category::all()->count();
        $data['ordersCount'] = Order::all()->count();
        $data['productsCount'] = Product::all()->count();

        return view('admin.index', compact('data'));
    }
}
