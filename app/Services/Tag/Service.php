<?php

namespace App\Services\Tag;

use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data)
    {
        try{
            DB::beginTransaction();
            Tag::firstOrCreate($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }


    }

    public function update($tag, $data)
    {
        try{
            DB::beginTransaction();
            $tag->update($data);
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $tag;
    }
}
