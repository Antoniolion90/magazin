<?php

namespace App\Services\Client;

use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        try{
            DB::beginTransaction();
            Client::firstOrCreate($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }


    }

    public function update($client, $data)
    {
        try{
            DB::beginTransaction();
            $client->update($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $client;
    }
}
