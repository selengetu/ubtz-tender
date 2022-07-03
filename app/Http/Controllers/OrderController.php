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
 
        $ostate= DB::select("select * from CONST_ORDER_STATE t order by state_name");
        $source= DB::select("select * from CONST_ORDER_BUDGET_SOURCE t ");
        $selection= DB::select("select * from CONST_ORDER_SELECTIONS t ");
        $dep= DB::select("select * from MEASINST.V_DEPART t ");
        $unit= DB::select("select * from CONST_UNIT t ");
        $order= DB::select("select * from V_ORDERS t ");
        $type= DB::select("select * from CONST_TENDER_TYPES t ");
        $tendertype= DB::select("select * from CONST_CONTRACT_TYPES t ");
        $tenderstate= DB::select("select t.* from CONST_TENDER_STATE t ");
        $employee= DB::select("select t.* from USERS t order by name ");
        return view('order.order',compact('dep','ostate','source','selection','unit','order','type','tendertype','tenderstate','employee'));
    }
    public function saveOrder(Request $request)
    {
        $id= Auth::user()->id;
        if($request->order_id ==  null){
        DB::insert("insert into ORDERS
        ( ORDER_NAME, ORDER_DATE, ORDER_UNIT, ORDER_COUNT, ORDER_SELECTION, ORDER_BUDGET_SOURCE, ORDER_BUDGET, ORDER_THISYEAR, ORDER_COMMENT, ORDER_EMPLOYEE, ADDED_USER)
        values
        ( '$request->order_name', '$request->order_date', $request->order_unit, '$request->order_count', '$request->order_selection', '$request->order_budget_source'
        , '$request->order_budget','$request->order_thisyear', '$request->order_comment', '$request->order_employee', '$id')");   
          }
            else{
    
                $orders = DB::table('ORDERS')
                ->where('order_id', $request->order_id)
                ->update(['order_name' => $request->order_name,'order_date' => $request->order_date,'order_unit' => $request->order_unit,'order_count' => $request->order_count,
                'order_selection' => $request->order_selection,'order_budget_source' => $request->order_budget_source,'order_budget' => $request->order_budget,
                'order_thisyear' => $request->order_thisyear,'order_comment' => $request->order_comment,'order_employee' => $request->order_employee]);        
            }
      
        return back();
    }
    public function getOrder($hid)
    {
        return DB::select("select * from V_ORDERS t where t.order_id='$hid'");
    }
    public function saveOrderDetail(Request $request)
    {
        $id= Auth::user()->id;
        if($request->detail_id ==  null){
            DB::insert("insert into ORDER_DETAIL
                ( ORDER_ID, DEP_ID, ORDER_COUNT, ORDER_BUDGET, ORDER_PERFORMANCE, ADDED_USER)
                values
                ( '$request->dorder_id', '$request->dep_id', '$request->dorder_count_detail','$request->dorder_budget','$request->dorder_performance', '$id')");
              }
                else{
        
                    $orders = DB::table('ORDER_DETAIL')
                    ->where('order_detail_id', $request->detail_id)
                    ->update(['dep_id' => $request->dep_id,'order_count' => $request->dorder_count_detail,'order_budget' => $request->dorder_budget,'order_performance' => $request->dorder_performance]);        
                }
                return 1;
    }
    public function getorderdetails($hid)
    {
        return DB::select("select * from V_ORDER_DETAIL t where t.order_id='$hid'");
    }
    public function getorderdetail($hid)
    {
        return DB::select("select * from V_ORDER_DETAIL t where t.order_detail_id='$hid'");
    }
}