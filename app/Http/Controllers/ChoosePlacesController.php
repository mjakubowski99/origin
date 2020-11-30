<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChoosePlacesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrive_data = json_decode( $request->input('arrive_data') );
        $arrive_data = collect( $arrive_data );
        $arrive_ids  = $arrive_data->pluck('arrive_id')->groupBy('arrive_id')->first()->unique();

        $train = DB::table('trains')
                    ->select(['id', 'name'])
                    ->whereIn('id', $arrive_ids)->get();

        $places = DB::table('train_places')
                    ->join('places', 'places.id', '=', 'train_places.PLACE_ID')
                    ->select(['train_places.id','train_places.TRAIN_ID','places.number', 'places.car'])
                    ->whereIn('train_places.TRAIN_ID', $train->pluck('id') )
                    ->get(); 

        return view('choosePlaces.index', [ 
            'arrive_ids' => $arrive_ids,
            'places' => \json_encode($places)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
