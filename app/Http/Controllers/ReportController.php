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
       
        $tenders=DB::select("select * from V_TENDERS");
        foreach ($tenders as $tender) {
          $tender->pack = DB::select('select * from V_TENDER_PACK t where t.pack_tender=' . $tender->tenderid . '');
        }
        foreach ($tenders as $tender) {
            $tender->detail = DB::select('select * from v_order_detail t where t.order_id=' . $tender->order_id . '');

        }
    
        return view('report.tender',compact('tenders'));
    }

    public function reportTenderDetail(Request $request)
    {
        $tender=DB::select("select * from V_TENDERS");
        return view('report.tenderdetail',compact('tender'));
    }
}
