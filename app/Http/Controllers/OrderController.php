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
        $source= DB::select("select * from CONST_ORDER_BUDGET_SOURCE t ");
        $selection= DB::select("select * from CONST_ORDER_SELECTIONS t ");
        $dep= DB::select("select * from EXAMUBTZ.V_DEPART t ");
        $unit= DB::select("select * from CONST_UNIT t ");
        $order= DB::select("select * from V_ORDERS t ");
        $type= DB::select("select * from CONST_TENDER_TYPES t ");
        $tendertype= DB::select("select * from CONST_CONTRACT_TYPES t ");
        $tenderstate= DB::select("select t.* from CONST_TENDER_STATE t ");
        return view('order.order',compact('dep','ostate','mstate','source','selection','unit','order','type','tendertype','tenderstate'));
    }
    public function saveOrder(Request $request)
    {
       
        DB::insert("insert into ORDERS
        ( ORDER_NAME, ORDER_DATE, ORDER_UNIT, ORDER_COUNT, ORDER_SELECTION, ORDER_BUDGET_SOURCE, ORDER_BUDGET, ORDER_THISYEAR, ORDER_STATE, ORDER_MAIN_STATE, ORDER_COMMENT)
        values
        ( '$request->order_name', '$request->order_date', $request->order_unit, '$request->order_count', '$request->order_selection', '$request->order_budget_source'
        , '$request->order_budget','$request->order_thisyear', $request->order_state,'$request->order_main_state', $request->order_comment)");
        return 1;
    }
    public function getOrder($hid)
    {
        return DB::select("select * from V_ORDERS t where t.order_id='$hid'");
    }
}
