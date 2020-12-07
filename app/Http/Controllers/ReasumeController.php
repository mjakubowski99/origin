<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReasumeController extends Controller
{
    public function index(Request $request){
        $places = json_decode( $request->input('clicked') );

        dd( $places );
        return view('reasume.index');
    }
}
