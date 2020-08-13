<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Train;
use App\Trace;
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
    private $messages = [ 'begin-at.date' => 'Podana wartość dla godziny odjazdu nie jest datą',
                          'arrive-at.date' => 'Podana wartość dla godziny przyjazdu nie jest datą',
                          'arrive-at-hour.regex' => 'Godzina nie zgodna z formatem. Uzyj formatu: [0-24]:[0-60]',
                          'begin-at-hour.regex' => 'Godzina nie zgodna z formatem. Uzyj formatu: [0-24]:[0-60]' ];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'begin-at' => 'required|date', 
            'begin-at-hour' => ['required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
            'arrive-at' => 'required|date', 
            'arrive-at-hour' => ['required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
            'train-search' => 'required', 
            'trace-search' => 'required',
        ], $this->messages);

        echo $request->input('station');

        //Now it's needed to check if train and trace exists in database

        $train = $request->input('train-search');
        $trace = $request->input('trace-search');
        $arriveDates = [ $request->input('begin-at'), $request->input('begin-at-hour'), $request->input('arrive-at'), $request->input('arrive-at-hour') ];


        //Record if exists
        $trainDatabase = Train::where('name', $train)->first();
        $traceDatabase = Trace::where('name', $trace)->first();

        if( $trainDatabase && $traceDatabase )
            $this->addNewArrive($trainDatabase->id , $traceDatabase->id, $arriveDates);
        else if( $trainDatabase )
            return redirect('customizeArrives')->with('error', 'Nie istnieje taka trasa');
        else if( $traceDatabase )
            return redirect('customizeArrives')->with('error', 'Nie istnieje taki pociąg');            
        else
            return redirect('customizeArrives')->with('error', 'Nie istnieje ani taki pociąg ani taka trasa'); 
    }

    private function addNewArrive($trainID, $traceID, $arriveDates){

        $beginDate = $arriveDates[0].' '.$arriveDates[1].":00";
        $arriveDate = $arriveDates[2].' '.$arriveDates[3].":00";

        $beginDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $beginDate);
        $arriveDateConverted = DateTime::createFromFormat('Y-m-d H:i:s', $arriveDate);

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
}
