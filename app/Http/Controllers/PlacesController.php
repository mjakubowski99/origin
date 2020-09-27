<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\DB;
use App\Station;
use App\PathFinding\PathFinder;
use DateTime;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('places.index')->with([ 
            'stations' =>  DB::table('stations')
                           ->select('name')
                           ->groupBy('name')
                            ->get()  
        ]); 
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
     * @param  \Illuminate\Http\TicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $dateOfJourney = $this->convertDate($request);
        $trace_begin = $request->input('trace-input-1');
        $trace_end = $request->input('trace-input-2');
        $pathFinder = new PathFinder();

        $founded_arrives = $pathFinder->findPath($dateOfJourney, $trace_begin, $trace_end);
        dd( $founded_arrives );

        $date_begin = collect();
        $date_end = collect();
        $trains = collect();


     /*   return view('chooseTrace.index', [
            'founded_arrives' => $founded_arrives, 
            'trace_begin' => $trace_begin, 
            'trace_end' => $trace_end
         ]); */
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


    




    //Helper private methods

    /**
     * Convert date and hour to DateTime.
     *
     * @param  TicketRequest $request
     * @return DateTime
     */
    private function convertDate(TicketRequest &$request){
        $dateOfJourney = $request->input('date-input').' '.$request->input('hour-input').":00";
        return DateTime::createFromFormat('Y-m-d H:i:s', $dateOfJourney);
    }

}
