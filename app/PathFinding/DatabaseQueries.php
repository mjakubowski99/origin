<?php

namespace App\PathFinding;
use Illuminate\Support\Facades\DB;
use DateTime;

class DatabaseQueries{

    public function getStationNameForStationID($station_id){
        return DB::table('stations')
                    ->select('name')
                    ->where('id', $station_id)
                    ->pluck('name')
                    ->first();
    }

    public function getStationsIDSForBeginStation($trace_begin){
        return DB::table('stations')
                ->where('name', $trace_begin)
                ->get()
                ->pluck('id')
                ->toArray();
    }

    public function getNextArriveID($arrive){
        return DB::table('arrives')
                 ->where('id', $arrive->id+1)
                 ->get()
                 ->pluck('arrive_id')
                ->first();
    }

    public function getStationIdsForStationName($name){
        return DB::table('stations')
                 ->select('id')
                 ->where('name', $name)
                 ->get()
                 ->pluck('id');
    }

    public function getArrivesFrom2DaysAfterBeginJourney($dateOfJourney){
        $maxDateOfArrives = new DateTime( $dateOfJourney->format('Y-m-d H:i:s') );
        \date_modify($maxDateOfArrives, '+2 day');

        return DB::table('arrives')
            ->select(
                'id',
                'ID_STATION', 
                'arrive_id',
                'begin_date', 
                'arrive_date'
            )->whereRaw(
                'begin_date >= ? and begin_date <= ?', 
                [$dateOfJourney, $maxDateOfArrives] 
            )->get();
    }
}