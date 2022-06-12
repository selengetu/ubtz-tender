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
        DB::insert("insert into Tenders
        (TENDERNO, TENDERTYPECODE, TENDERSELECTIONCODE, TENDER_CALL_AT, TENDER_OPEN_AT, TENDER_BUDGET, TENDER_BUDGET_SOURCE, TENDERTITLE, TENDER_INVITATIONCODE, TENDER_INVITATION_AT, TENDER_VALIDDATE, PACKCOUNT,
         ASSESSMENT, TENDER_PLAYER,TENDER_STATE, ASSESSMENT_AT,STATEMENT_AT,CONTRACT_AT,SUSPENDED_AT,COMPLAINT_AT,ORDER_ID)
        values
        ($request->tenderno, $request->tendertypecode,$request->tenderselectioncode, '$request->tender_call_at', '$request->tender_open_at', $request->tender_budget, '1', '$request->tendertitle', '$request->tender_invitationcode',
        '$request->tender_invitation_at','$request->tender_validdate', $request->packcount,'$request->assessment', '$request->tender_player',$request->tender_state, '$request->assesstment_at','$request->statement_at',
       '$request->contract_at','$request->suspended_at','$request->complaint_at','$request->order_id')");
        return 1;
    }
    public function getTenders($hid)
    {
        return DB::select("select * from TENDERS t where t.order_id='$hid'");
    }
  
}
