<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Train;

class CustomizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trains = Train::all();
        return view('customizeTrain.index', [ 'trains' => $trains ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $trainName = $request->input('tname');
       DB::table('trains')->insert([
            'name' => $trainName,
       ]);     

       if( Train::where('name', $trainName)->first() )
            return redirect('/customizeTrain')->with(
                'success', 
                "Pomyslnie dodano do bazy danych!"
            );
       else
            return redirect('/customizeTrain')->with(
                'error', 
                "Blad dodania do bazy danych!"
            );
    }
}
