<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class OrderController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $jobid= Auth::user()->jobid;
        $id= Auth::user()->id;
        $query = "";
        $ostate= DB::select("select * from CONST_ORDER_STATE t order by state_name");
        $source= DB::select("select * from CONST_ORDER_BUDGET_SOURCE t");
        $selection= DB::select("select * from CONST_ORDER_SELECTIONS t");
        $dep= DB::select("select * from MEASINST.V_DEPART t");
        $unit= DB::select("select * from CONST_UNIT t");
        $count_order= DB::select("select count(order_id) as count from V_ORDERS t")[0];
        $currency= DB::select("select * from CONST_CURRENCY t order by currency_id");
        $type= DB::select("select * from CONST_TENDER_TYPES t");
        $tendertype= DB::select("select * from CONST_CONTRACT_TYPES t");
        $tenderstate= DB::select("select t.* from CONST_TENDER_STATE t");
        $employee= DB::select("select t.* from V_USERS t where jobcode <5 order by first_name");
        $contract_type= DB::select("select t.* from CONST_CONTRACT_TYPES t");
        if ($jobid == 4) {
            $query.=" and order_employee = '". $id."'";

        }
        else
        {
            $query.=" ";

        }
        $order= DB::select("select * from V_ORDERS t where 1=1  $query");

      
        return view('order.order',compact('dep','ostate','source','selection','unit','order','type','tendertype','tenderstate','employee','currency','contract_type','count_order'));
    }
    public function saveOrder(Request $request)
    {
        $id= Auth::user()->id;
        $order_budget = preg_replace('/[a-zZ-a,]/', '',$request->order_budget);
        $order_thisyear = preg_replace('/[a-zZ-a,]/', '',$request->order_thisyear);

        if($request->order_id ==  null){
        DB::insert("insert into ORDERS
        ( ORDER_NAME, ORDER_DATE, ORDER_UNIT, ORDER_COUNT, ORDER_SELECTION, ORDER_BUDGET_SOURCE, ORDER_BUDGET, ORDER_THISYEAR, ORDER_COMMENT, ORDER_EMPLOYEE, ADDED_USER)
        values
        ( '$request->order_name', TO_DATE('$request->order_date', 'yyyy-mm-dd'), $request->order_unit, '$request->order_count', '$request->order_selection', '$request->order_budget_source'
        , '$order_budget','$order_thisyear', '$request->order_comment', '$request->order_employee', '$id')");   
          }
            else{
    
                $orders = DB::table('ORDERS')
                ->where('order_id', $request->order_id)
                ->update(['order_name' => $request->order_name,'order_date' => $request->order_date,'order_unit' => $request->order_unit,'order_count' => $request->order_count,
                'order_selection' => $request->order_selection,'order_budget_source' => $request->order_budget_source,'order_budget' => $order_budget,
                'order_thisyear' => $order_thisyear,'order_comment' => $request->order_comment]);        
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
        $dorder_budget = preg_replace('/[a-zZ-a,]/', '',$request->dorder_budget);
        $dorder_performance = preg_replace('/[a-zZ-a,]/', '',$request->dorder_performance);
        if($request->detail_id ==  null){
            DB::insert("insert into ORDER_DETAIL
                ( ORDER_ID, DEP_ID, ORDER_COUNT, ORDER_BUDGET, ORDER_PERFORMANCE, ADDED_USER)
                values
                ( '$request->dorder_id', '$request->dep_id', '$request->dorder_count_detail','$dorder_budget','$dorder_performance', '$id')");
              }
                else{
        
                    $orders = DB::table('ORDER_DETAIL')
                    ->where('order_detail_id', $request->detail_id)
                    ->update(['dep_id' => $request->dep_id,'order_count' => $request->dorder_count_detail,'order_budget' => $dorder_budget,'order_performance' => $dorder_performance]);        
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
    public function delDetail($hid)
    {
        $user = DB::table('ORDER_DETAIL')
        ->where('ORDER_DETAIL_ID',$hid)
        ->update(['is_active' => 0]);
            return 1;
    }
    public function delOrder($hid)
    {
        $user = DB::table('ORDERS')
        ->where('order_id',$hid)
        ->update(['is_active' => 0]);
            return 1;
    }
}