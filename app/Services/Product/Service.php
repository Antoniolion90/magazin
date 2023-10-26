<?php

namespace App\Services\Product;

use App\Models\Product;
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
            Product::firstOrCreate($data);
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
            $product->update($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $product;
    }
}
