<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TraceRepository;

class ReasumeController extends Controller
{
    public function index(Request $request){
        $places = json_decode( $request->input('clicked') );
        $arrives = json_decode( $request->input('arrive_ids') );

        $repository = new TraceRepository();
        $traces = $repository->traceNamesForArrives($arrives);
     
        return view('reasume.index', [
            'places' => $places,
            'arrives' => $arrives
        ]);
    }
}
