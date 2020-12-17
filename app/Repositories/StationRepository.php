<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class StationRepository extends Repository{

    public function stationForArrive($arrive_id){
        return DB::table('arrives')->select('ID_STATION')
                ->where('arrive_id', $arrive_id)
                ->first();
    }
}