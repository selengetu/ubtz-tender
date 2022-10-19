<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ContractprogressController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function saveContractProgress(Request $request)
    {
        $id= Auth::user()->id;
        if($request->contract_progress_id ==  null){
            DB::insert("insert into contract_progress
            (contract_progress_state, contract_progress_date, contract_progress_comment, p_contract_id, ADDED_USER)
            values
            ('$request->contract_progress_state', '$request->contract_progress_date','$request->contract_progress_comment','$request->p_contract_id', '$id')");
            
              }
                else{
        
                    $orders = DB::table('contract_progress')
                    ->where('contract_progress_id', $request->contract_progress_id)
                    ->update(['contract_progress_state' => $request->contract_progress_state,'contract_progress_date' => $request->contract_progress_date,'contract_progress_comment' => $request->contract_progress_comment, 'p_contract_id' =>  $request->p_contract_id]);        
                }

        return 1;
    }
    
    public function getcontractprogresses($hid)
    {
        return DB::select("select * from V_CONTRACT_PROGRESS t where t.p_contract_id='$hid'");
    }
    public function getcontractprogress($hid)
    {
        return DB::select("select * from V_CONTRACT_PROGRESS t where t.progress_id='$hid'");
    }
}
