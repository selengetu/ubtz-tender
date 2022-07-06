<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ReportController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function reportTender(Request $request)
    {
        $dep= DB::select("select * from MEASINST.V_DEPART t ");
        $tenders=DB::select("select * from V_TENDERS");
        $type= DB::select("select * from CONST_TENDER_TYPES t ");
        $tendertype= DB::select("select * from CONST_CONTRACT_TYPES t ");
        foreach ($tenders as $tender) {
          $tender->pack = DB::select('select * from V_TENDER_PACK t where t.pack_tender=' . $tender->tenderid . '');
        }
        foreach ($tenders as $tender) {
            $tender->detail = DB::select('select * from v_order_detail t where t.order_id=' . $tender->order_id . '');

        }
    
        return view('report.tender',compact('tenders','dep','type','tendertype'));
    }

    public function reportTenderDetail(Request $request)
    {
        $tender=DB::select("select * from V_TENDERS");
        return view('report.tenderdetail',compact('tender'));
    }
}
