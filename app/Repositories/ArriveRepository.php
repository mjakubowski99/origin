<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class ArriveRepository extends Repository{

    public function arriveIds($arriveData){
        $arrive_data = collect( json_decode( $arriveData ) );
        $arrive_ids  = $arrive_data
                        ->pluck('arrive_id')
                        ->groupBy('arrive_id')
                        ->first()
                        ->unique();

        return $arrive_ids;
    }
}