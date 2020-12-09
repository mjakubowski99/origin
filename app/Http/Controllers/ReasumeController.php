<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReasumeController extends Controller
{
    public function index(Request $request){
        $places = json_decode( $request->input('clicked') );
        $arrives = json_decode( $request->input('arrive_ids') );

        
        return view('reasume.index');
    }
}
