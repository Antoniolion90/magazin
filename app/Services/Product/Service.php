<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\ProductTag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data)
    {
        try{
            DB::beginTransaction();
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            $tagsIds = $data['tags'];
            unset($data['tags']);

            $product = Product::firstOrCreate($data);

            $product->tags()->attach($tagsIds);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }

    }

    public function update($product, $data)
    {
        try{
            DB::beginTransaction();
            if (isset($data['image'])) {
                $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            }
            $tagsIds = $data['tags'];
            unset($data['tags']);

            $product->update($data);
            $product->tags()->sync($tagsIds);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $product;
    }
}
