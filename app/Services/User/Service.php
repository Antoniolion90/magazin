<?php

namespace App\Services\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        try{
            DB::beginTransaction();
            User::firstOrCreate($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }


    }

    public function update($user, $data)
    {
        try{
            DB::beginTransaction();
            $user->update($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $user;
    }
}
