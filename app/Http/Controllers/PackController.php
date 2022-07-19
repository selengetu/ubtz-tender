<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class PackController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function savePack(Request $request)
    {
        $id= Auth::user()->id;
        $pack_budget = preg_replace('/[a-zZ-a,]/', '',$request->pack_budget);
        if($request->pack_id ==  null){
            DB::insert("insert into tender_pack
            (pack_name, pack_date, pack_budget, pack_contract_at, pack_suspended_at, pack_complaint_at, pack_tender, pack_order_id, ADDED_USER)
            values
            ('$request->pack_name', '$request->pack_date','$pack_budget', TO_DATE('$request->pack_contract_at', 'yyyy-mm-dd'), TO_DATE('$request->pack_suspended_at', 'yyyy-mm-dd'), 
            TO_DATE('$request->pack_complaint_at', 'yyyy-mm-dd'),'$request->tender_list_id','$request->pack_order_id', '$id')");
            
              }
                else{
        
                    $orders = DB::table('tender_pack')
                    ->where('pack_id', $request->pack_id)
                    ->update(['pack_name' => $request->pack_name,'pack_date' => $request->pack_date,'pack_budget' => $pack_budget,'pack_contract_at' => $request->pack_contract_at,
                    'pack_suspended_at' =>  $request->pack_suspended_at,'pack_complaint_at' => $request->pack_complaint_at]);        
                }

        return 1;
    }
    
    public function getpacks($hid)
    {
        return DB::select("select * from V_TENDER_PACK t where t.pack_tender='$hid'");
    }
    public function getpack($hid)
    {
        return DB::select("select * from V_TENDER_PACK t where t.pack_id='$hid'");
    }
   
}
