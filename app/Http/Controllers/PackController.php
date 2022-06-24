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
        if($request->pack_id ==  null){
            DB::insert("insert into tender_pack
            (pack_name, pack_date, pack_budget, pack_contract_at, pack_suspended_at, pack_complaint_at, pack_tender)
            values
            ('$request->pack_name', '$request->pack_date','$request->pack_budget', TO_DATE('$request->pack_contract_at', 'yyyy-mm-dd'), TO_DATE('$request->pack_suspended_at', 'yyyy-mm-dd'), TO_DATE('$request->pack_complaint_at', 'yyyy-mm-dd'),'$request->pack_tender')");
            
              }
                else{
        
                    $orders = DB::table('tender_pack')
                    ->where('pack_id', $request->tender_id)
                    ->update(['tenderselectioncode' => $request->tenderselectioncode,'tenderno' => $request->tenderno,'tendertypecode' => $request->tendertypecode,'tender_call_at' => $request->tender_call_at,
                    'tender_open_at' =>  $request->tender_open_at,'tender_budget' => $request->tender_budget,'tendertitle' => $request->tender_title,
                    'tender_invitationcode' => $request->tender_invitationcode,'tender_invitation_at' =>  $request->tender_invitation_at,'tender_validdate' => $request->tender_validdate,'packcount' => $request->packcount
                    ,'assessment' => $request->assessment,'tender_state' => $request->tender_state,'assessment_at' => $request->assessment_at]);        
                }

        return 1;
    }
    
    public function getPacks($hid)
    {
        return DB::select("select * from V_TENDERS t where t.order_id='$hid'");
    }
    public function getPack($hid)
    {
        return DB::select("select * from V_TENDERS t where t.tenderid='$hid'");
    }
   
}
