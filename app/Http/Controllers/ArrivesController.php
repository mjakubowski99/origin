<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Train;
use App\Trace;
use App\Station;
use DateTime;

class ArrivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('arrives.index')->with([ 'trains' => Train::all(), 'traces' => Trace::all() ]);
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

    /** Form validation messages */
    private $messages = [ 'date' => 'Podana wartość nie jest datą',
                          'regex' => 'Podana wartość nie jest godziną' ];

    private function createValidateTable($input){
        $validateTable = array();
        foreach( $input as $key => $value ){
            if( $this->startsWith($key, 'hour-') ){
                $validateTable[$key] = ['required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'];
            }
            else if( $this->startsWith($key, 'date-') ){
                $validateTable[$key] = 'required|date';
            }
        }

        $validateTable['train-search'] = 'required';
        $validateTable['trace-search'] = 'required';

        return $validateTable;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =  $request->input();
        $validateTable = $this->createValidateTable($input);

        $validateData = $request->validate( $validateTable, $this->messages);

        //Now it's needed to check if train and trace exists in database

        $train = $request->input('train-search');
        $trace = $request->input('trace-search');


        //Record if exists
        $trainDatabase = Train::where('name', $train)->first();
        $traceDatabase = Trace::where('name', $trace)->first();

        if( $trainDatabase && $traceDatabase ){
            $this->addNewArrive($trainDatabase->id , $traceDatabase->id, $input);           
            return redirect('customizeArrives')->with('success', 'Pomyślnie dodano do bazy danych!');
        }
        else if( $trainDatabase )
            return redirect('customizeArrives')->with('error', 'Nie istnieje taka trasa');
        else if( $traceDatabase )
            return redirect('customizeArrives')->with('error', 'Nie istnieje taki pociąg');            
        else
            return redirect('customizeArrives')->with('error', 'Nie istnieje ani taki pociąg ani taka trasa');
    }

    private function addNewArrive($trainID, $traceID, $arriveDates){
        //$beginDate = $arriveDates[0].' '.$arriveDates[1].":00"; //concatenation date and hours
       // $arriveDate = $arriveDates[2].' '.$arriveDates[3].":00";

       $maxIndex = (count($arriveDates)-2)/2;
       $stations = Trace::find($traceID)->stations;

       $stationIterator = 0;
       for($i=0; $i<$maxIndex-1; $i+=2){
           $beginDate = $arriveDates[ 'date-'.($i) ].' '.$arriveDates[ 'hour-'.($i) ].":00";
           $arriveDate = $arriveDates[ 'date-'.($i+1) ].' '.$arriveDates[ 'hour-'.($i+1) ].":00";

           $beginDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $beginDate);
           $arriveDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $arriveDate);

           DB::table('arrives')->insert([
               'ID_TRAIN' => $trainID,
               'ID_STATION' => $stations[$stationIterator]->id,
               'BEGIN_DATE' => $beginDateConverted,
               'ARRIVE_DATE' => $arriveDateConverted,
           ]); 

           $stationIterator++;
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    public function get($trace_name){
        $trace = DB::table('traces')->where('name', $trace_name)->first();

        $stations = Station::where('ID_TRACE', $trace->id)->get();   
        //return json_encode($stations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return response()->json( $stations );
    }

    private function startsWith ($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 

    public function test(){
        $stations = Trace::find(1)->stations;
        foreach( $stations as $station ){
            echo $station;
        }
    }
}
