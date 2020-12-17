<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\DB;
use App\Station;
use App\Repositories\FitToDateArrivesRepository;

class TraceFindController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $repository = new FitToDateArrivesRepository($request->input());
        $foundedArrives = $repository->arrives();

        return view('chooseTrace.index', [
            'founded_arrives' => $foundedArrives, 
            'trace_begin' => $repository->traceBegin, 
            'trace_end' => $repository->traceEnd
        ]); 
    }


}
