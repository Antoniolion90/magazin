<?php

namespace App\Services\Order;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data)
    {
        try{
            DB::beginTransaction();
            Order::firstOrCreate($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }


    }

    public function update($order, $data)
    {
        try{
            DB::beginTransaction();
            $order->update($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $order;
    }
}
