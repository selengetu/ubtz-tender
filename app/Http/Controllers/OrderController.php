<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class OrderController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {

        $dep= DB::select("select * from EXAMUBTZ.V_DEPART t ");
        return view('main.order',compact('dep'));
    }
 
}
