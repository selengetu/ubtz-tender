<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class TenderStateController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
      
        $state= DB::select("select * from const_tender_state t ");
        return view('const.tenderstate',compact('state'));
    }

    public function saveTenderState(Request $request)
    {
        $id= Auth::user()->id;
        if($request->state_id ==  null){
            DB::insert("insert into const_tender_state
            (state_name)
            values
            ('$request->state_name')");
            
              }
                else{
        
                    $orders = DB::table('const_tender_state')
                    ->where('state_id', $request->state_id)
                    ->update(['state_name' => $request->state_name]);        
                }

        return back();
    }
    
    public function getTenderState($hid)
    {
        return DB::select("select * from CONST_TENDER_STATE t where t.state_id='$hid'");
    }

}
