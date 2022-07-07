<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Session;
class ReportController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function reportTender(Request $request)
    {
        $query = "";
        $query1 = "";
        $sdep ='';
        $stendertype = '';
        $sselection = '';

        $dep= DB::select("select * from MEASINST.V_DEPART t ");
      
        $type= DB::select("select * from CONST_TENDER_TYPES t ");
        $tendertype= DB::select("select * from CONST_CONTRACT_TYPES t ");

        if(Session::has('sdep')) {
            $sdep = Session::get('sdep');

        }
        else {
            Session::put('sdep', $sdep);
        }
        if(Session::has('stendertype')) {
            $stendertype = Session::get('stendertype');

        }
        else {
            Session::put('stendertype', $stendertype);
        }
        if(Session::has('sselection')) {
            $sselection = Session::get('sselection');

        }
        else {
            Session::put('sselection', $sselection);
        }
        if ($sdep!=NULL && $sdep !=0) {
            $query1 = "where dep_id = '".$sdep."'";

        }
        else
        {
            $query1.=" ";

        }
        if ($stendertype!=NULL && $stendertype !=0) {
            $query.=" and tendertypecode = '".$stendertype."'";
        }
        else
        {
            $query.=" ";
        }
        if ($sselection!=NULL && $sselection !=0) {
            $query.=" and tenderselectioncode = '".$sselection."'";
        }
        else
        {
            $query.=" ";
        }

        $tenders=DB::select("SELECT * FROM V_TENDERS t
        WHERE t.order_id IN (select order_id from ORDER_DETAIL t " .$query1." )");
       
        foreach ($tenders as $tender) {
          $tender->pack = DB::select('select * from V_TENDER_PACK t where t.pack_tender=' . $tender->tenderid . '');
        }
        foreach ($tenders as $tender) {
            $tender->detail = DB::select('select * from v_order_detail t where t.order_id=' . $tender->order_id . '');

        }
    
        return view('report.tender',compact('tenders','dep','type','tendertype','stendertype','sselection','sdep'));
    }

    public function reportTenderDetail(Request $request)
    {
        $tender=DB::select("select * from V_TENDERS");
        return view('report.tenderdetail',compact('tender'));
    }
    public function filter_dep($sdep) {
        Session::put('sdep',$sdep);
        return back();
    }
    public function filter_tendertype($stendertype) {
        Session::put('stendertype',$stendertype);
        return back();
    }
    public function filter_selection($sselection) {
        Session::put('sselection',$sselection);
        return back();
    }
}
