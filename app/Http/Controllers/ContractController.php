<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ContractController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function saveContract(Request $request)
    {
        $id= Auth::user()->id;
        $contract_amount = preg_replace('/[a-zZ-a,]/', '',$request->contract_amount);

        if($request->contractid ==  null){
          
            DB::insert("insert into CONTRACTS
            (CONTRACTNO, CONTRACT_DATE, CONTRACT_DURATION_DAYS, CONTRACT_END_DATE, CONTRACT_PAYMENT_DATE, CONTRACTOR_NAME, CONTRACT_AMOUNT, CURRENCY, PERFORMANCE_NOTE, PERFORMANCE_PERCENT, FINE_PERCENT,
            FINE_CONDITION, CONTRACT_STATE,CONTRACT_TITLE, SUPPLIER_CONDITION ,SUPPLIER_DAYS ,SUPPLIER_NAME, CONTRACT_CONDITION ,CONTRACT_CLARIFICATION ,CONTRACT_CONCLUSION, CONTRACT_REMINDER ,TENDERID)
            values
            ('$request->contractno' , TO_DATE('$request->contract_date', 'yyyy-mm-dd'), '$request->contract_duration_days',  TO_DATE('$request->contract_end_date', 'yyyy-mm-dd'), TO_DATE('$request->payment_date', 'yyyy-mm-dd') ,'$request->contractor_name', '$contract_amount',
            '$request->currency','$request->performance_note', '$request->performance_percent','$request->fine_percent', '$request->fine_condition',TO_DATE('$request->contract_state', 'yyyy-mm-dd'), '$request->contract_title','$request->supplier_condition',
           '$request->supplier_days','$request->supplier_name','$request->contract_condition','$request->contract_clarification','$request->contract_conclusion','$request->contract_reminder','$request->contract_tender')");
            return 1;
          }
            else{
    
                $orders = DB::table('CONTRACTS')
                ->where('contractid', $request->contractid)
                ->update(['contractno' => $request->contractno,'contract_date' => $request->contract_date,'contract_duration_days' => $request->contract_duration_days,'contract_end_date' => $request->contract_end_date,
                'payment_date' => $request->payment_date,'contractor_name' => $request->contractor_name,'contract_amount' => $contract_amount,'currency' => $request->currency,'performance_note' => $request->performance_note,'performance_percent' => $request->performance_percent
                ,'fine_percent' => $request->fine_percent,'fine_condition' => $request->fine_condition,'contract_state' => $request->contract_state,'supplier_condition' => $request->supplier_condition,'fine_condition' => $request->fine_condition,'supplier_days' => $request->supplier_days,'supplier_name' => $request->supplier_name,
                'contract_condition' => $request->contract_condition,'contract_clarification' => $request->contract_clarification,'contract_conclusion' => $request->contract_conclusion,'contract_reminder' => $request->contract_reminder]);        
            }

       
    }
    public function getContracts($hid)
    {
        return DB::select("select * from V_CONTRACTS t where t.tenderid='$hid'");
    }
    public function getContract($hid)
    {
        return DB::select("select * from V_CONTRACTS t where t.contractid='$hid'");
    }
}
