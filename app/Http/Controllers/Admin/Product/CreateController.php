<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Category;
use App\Models\Tag;


class CreateController extends BaseController
{
    public function __invoke()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.product.create', compact('categories', 'tags'));
    }
}
