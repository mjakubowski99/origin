<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class PlaceRepository extends Repository{

    public function placesForTrain($train_id){
        return DB::table('train_places')
                ->join('places', 
                       'places.id', 
                       '=', 
                       'train_places.PLACE_ID'
                )
                ->select([
                    'train_places.id',
                    'train_places.TRAIN_ID',
                    'places.number', 
                    'places.car'
                ])
                ->whereIn('train_places.TRAIN_ID', $train_id )
                ->get(); 
    }
}