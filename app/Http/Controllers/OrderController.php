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
        $mstate= DB::select("select * from CONST_MAIN_STATE t order by state_name");
        $ostate= DB::select("select * from CONST_ORDER_STATE t order by state_name");
        $source= DB::select("select * from CONST_TENDER_BUDGET_SOURCE t ");
        $selection= DB::select("select * from CONST_TENDER_SELECTIONS t ");
        $dep= DB::select("select * from EXAMUBTZ.V_DEPART t ");
        $unit= DB::select("select * from CONST_UNIT t ");
        return view('main.order',compact('dep','ostate','mstate','source','selection','unit'));
    }
 
}
