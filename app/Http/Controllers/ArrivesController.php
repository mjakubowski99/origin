<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
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
    public function create(Request $request)
    {
        
    }

    /** Form validation messages */
    private $messages = [ 
        'date' => 'Podana wartość nie jest datą',
        'regex' => 'Podana wartość nie jest godziną' 
    ];


     /**
     * Function create array with validations rules
     * @param array $input
     * @return array
     */                      
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

        //If trains and traces exists adding new record to database Else redirect with error
        if( $trainDatabase && $traceDatabase ){
            $this->addNewArrive(
                $trainDatabase->id , 
                $traceDatabase->id, 
                $input
            );           
            return redirect('customizeArrives')
                ->with('success', 'Pomyślnie dodano do bazy danych!');
        }
        else if( $trainDatabase )
            return redirect('customizeArrives')
                ->with('error', 'Nie istnieje taka trasa');
        else if( $traceDatabase )
            return redirect('customizeArrives')
                ->with('error', 'Nie istnieje taki pociąg');            
        else
            return redirect('customizeArrives')
                ->with('error', 'Nie istnieje ani taki pociąg ani taka trasa');
    }

      /**
     * Store a validated data in database.
     *
     * @param  int $trainID, int $traceID, array $arrivesDates
     * @return void
     */
    private function addNewArrive($trainID, $traceID, $arriveDates){
       /*we have 3 first records in $arrivesDates which are not date and hour. We must divide by two because are 2 dates and 2 hours on 1 row
        well count of indexes for 'date-' and 'hour-' is stored in maxIndex || echo dd($arriveDates) help to understand whats going on in loop*/

       $maxIndex = (count($arriveDates)-3)/2;
       $stations = Trace::find($traceID)->stations; //stations which have $traceID value

       $stationIterator = 0; //variable to iterate after station records

       $max_id = DB::table('arrives')->max('arrive_id');
       if( $max_id == null )
            $max_id = 0;

       for($i=0; $i<$maxIndex; $i+=2){ //in loop we doing +=2 because in one iteration we use $i and $i+1 value
            $beginDate = $arriveDates[ 'date-'.($i) ].' '.$arriveDates[ 'hour-'.($i) ].":00"; //concatenating date and hour to one variable
            $arriveDate = $arriveDates[ 'date-'.($i+1) ].' '.$arriveDates[ 'hour-'.($i+1) ].":00";

            $beginDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $beginDate);
            $arriveDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $arriveDate);


            DB::table('arrives')->insert([                             //storing validated data
                'ID_TRAIN' => $trainID,
                'arrive_id' => $max_id+1,
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

      /**
     * Return json response with station information
     *
     * @param  string  $trace_name
     * @return \Illuminate\Http\Response
     */
    public function get($trace_name){
        $trace = DB::table('traces')->where('name', $trace_name)->first();
        $stations = Station::where('ID_TRACE', $trace->id)->get();   

        return response()->json( $stations );
    }

      /**
     * Helper function to check if string startsWith another string
     *
     * @param  string  $string, string $startString
     * @return boolean
     */
    private function startsWith ($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 
}
