<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class TraceRepository extends Repository{

    public function traceForStation($station_id){
        return DB::table('stations')->select('ID_TRACE')
                ->where('id', $station_id)
                ->first();
    }

    public function traceNameForTraceId($traceID){
        return DB::table('traces')->select('NAME')
                ->where('id', $traceID)
                ->first();
    }

    public function traceNamesForArrives($arrive_ids){
        $tracesForArrives = collect([]);
        $stationRepo = new StationRepository();

        foreach( $arrive_ids as $arrive_id){
            $stationOnArrive = $stationRepo
                ->stationForArrive($arrive_id);

            $traceForStation = $this
                ->traceForStation($stationOnArrive->ID_STATION);

            $traceName = $this
                ->traceNameForTraceId($traceForStation->ID_TRACE);

            $tracesForArrives->push($traceName->NAME);
        }

        return $tracesForArrives;
    }
}