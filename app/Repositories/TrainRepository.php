<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class TrainRepository extends Repository{

    public function trainForArriveId($arrive_ids){
        return DB::table('trains')
                    ->select('id')
                    ->whereIn('id', $arrive_ids)
                    ->get()
                    ->pluck('id');
    }
}