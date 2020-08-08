<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('station.index');
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
        $validate_array = $this->makeValidateArray( $request->input() );
        $request->validate( $validate_array, ['required' => 'Atrybut :attribute jest wymagany.'] ); //with changed error info

        // if we are in this place form is validated with success
        if( count($validate_array) < 3 )
            return redirect('/customizeStation',)->with('error', 'Muszą być przynajmniej dwa pociągi na trasie');

        DB::table('traces')->insert([ 'name' => $request->input('trace_name') ] );
        
        $trace_id = DB::table('traces')->max('id');
        $number = 0;
        foreach( $request->input() as $stations ){
            if( $number > 1 ){
                DB::table('stations')->insert([ 'name' => $stations, 
                'id_trace' => $trace_id, 'station_in_order' => $number-1 ]);
            }
            $number++;
        }

        return redirect('/customizeStation',)->with('success', 'Pomyslnie dodano trase');
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
    public function destroy()
    {
        DB::table('traces')->truncate();
        DB::table('stations')->truncate();
    }

    private function makeValidateArray($input){
        $validate_array = [];
        $counter = 0;
        foreach( $input as $ipt){
            if( $counter == 1 ){
                $validate_array['trace_name'] = 'required';
            }
            else if( $counter > 1 ){
                $validate_array['station-'.strval($counter-2) ] = 'required';
            }
            $counter++;
        }

        return $validate_array;
    }
}
