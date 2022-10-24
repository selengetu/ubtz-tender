<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class TenderController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function saveTender(Request $request)
    {
        $id= Auth::user()->id;
        $tender_budget = preg_replace('/[a-zZ-a,]/', '',$request->tender_budget);
        if($request->tender_id ==  null){
            DB::insert("insert into Tenders
            (TENDERNO, TENDERTYPECODE, TENDERSELECTIONCODE, TENDER_CALL_AT, TENDER_OPEN_AT, TENDER_BUDGET, TENDERTITLE, TENDER_INVITATIONCODE, TENDER_VALIDDATE, PACKCOUNT,
             ASSESSMENT, TENDER_STATE, ASSESSMENT_AT, ORDER_ID, ADDED_USER)
            values
            ('$request->tenderno', '$request->tendertypecode','$request->tenderselectioncode', TO_DATE('$request->tender_call_at', 'yyyy-mm-dd'), TO_DATE('$request->tender_open_at', 'yyyy-mm-dd'), '$tender_budget', '$request->tender_title', '$request->tender_invitationcode',
            TO_DATE('$request->tender_validdate', 'yyyy-mm-dd'), '$request->packcount','$request->assessment','1', TO_DATE('$request->assesstment_at', 'yyyy-mm-dd'),'$request->torder_id', '$id')");
            
              }
                else{
        
                    $orders = DB::table('Tenders')
                    ->where('tenderid', $request->tender_id)
                    ->update(['tenderselectioncode' => $request->tenderselectioncode,'tenderno' => $request->tenderno,'tendertypecode' => $request->tendertypecode,'tender_call_at' => $request->tender_call_at,
                    'tender_open_at' =>  $request->tender_open_at,'tender_budget' => $tender_budget,'tendertitle' => $request->tender_title,
                    'tender_invitationcode' => $request->tender_invitationcode,'tender_validdate' => $request->tender_validdate,'packcount' => $request->packcount
                    ,'assessment' => $request->assessment,'assessment_at' => $request->assessment_at]);        
                }

        return 1;
    }
    
    public function getTenders($hid)
    {
        return DB::select("select * from V_TENDERS t where t.order_id='$hid'");
        
    }
    public function getTender($hid)
    {
        return DB::select("select * from V_TENDERS t where t.tenderid='$hid'");
    }
    public function delTender($hid)
    {
        $user = DB::table('TENDERS')
        ->where('tenderid',$hid)
        ->update(['is_active' => 0]);
            return 1;
    }
}
