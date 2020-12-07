<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ArriveRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\TrainRepository;

class ChoosePlacesController extends Controller
{
    public $places;
    public $trains;
    public $arrives;

    public function __construct(){
        $this->places = new PlaceRepository;
        $this->trains = new TrainRepository;
        $this->arrives = new ArriveRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrive_ids = $this->arrives
                        ->arriveIds( $request->input('arrive_data') );
        $train_ids = $this->trains
                        ->trainForArriveId($arrive_ids);
        $places = $this->places
                        ->placesForTrain( $train_ids );

        return view('choosePlaces.index', [ 
            'arrive_ids' => $arrive_ids,
            'places' => \json_encode($places)
        ]);
    }
}
