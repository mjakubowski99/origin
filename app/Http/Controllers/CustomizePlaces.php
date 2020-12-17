<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlacesTrains;
use App\Train;
use App\Place;
use Illuminate\Support\Facades\DB;

class CustomizePlaces extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created places in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $train_id = $request->input('train_id'); 
        $car_number = $request->input('car_number');
        $place = $request->input('place');

        if ( $this->validator( [$train_id, $car_number, $place])  ){  
           $train_id = intval($train_id);
           $train = Train::where('id', $train_id)->first(); //check if that train exists 
           
           if( $train ){
               $car = intval($car_number);
               $count_places = intval($place);
               $place_index = $this->getPlaceIndex();
               $this->insertPlacesToDatabase($car, $count_places, $place_index, $train_id);
               return redirect('/customizeTrain')->with('added', 'Pomyślnie dodano miejsca');
           }
           else
              return redirect('/customizeTrain')->with('numericError', 'Nie ma takiego id pociagu');
        }
        else
            return redirect('/customizeTrain')->with('numericError', 'Podaj wartosc liczbowa'); 
    }

    private function validator($toValidate){
        foreach( $toValidate as $toVal ){
            if ( !is_numeric( $toVal ) ){
                return false;
            }
        }
        return true;
    }

    
    /**
     * Allow you to get place index
     *
     * @return int $placeIndex
     */
    private function getPlaceIndex(){
        $placeIndex = DB::table('places')->max('id');
        if( $placeIndex == null )
             $placeIndex = 0;
        return $placeIndex;
    }

    /**
     * Insert records to places database and database which connect train with place
     *
     * @params  int $car, $count_places, $place_index, $train_id
     * @return boolean
     */
    private function insertPlacesToDatabase($car, $count_places, $place_index, $train_id){    
        for( $i=0; $i<$count_places; $i++ ){
            DB::table('places')->insert(['car' => $car, 'number'=> $i+1]);
            $place_index++;
            DB::table('train_places')->insert(['train_id' => $train_id, 'place_id' => $place_index]);
        }
    }
}
