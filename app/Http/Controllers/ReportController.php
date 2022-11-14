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
        $jobid= Auth::user()->jobid;
        $id= Auth::user()->id;
     
        $query = "";
        $query1 = "";
        $sdep ='';
        $stendertype = '';
        $sselection = '';

        $deps= DB::select("select * from V_DEPART t ");
      
        $types= DB::select("select * from CONST_TENDER_TYPES t ");
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
            $type =DB::select('select t.executor_type from V_DEPART t where t.dep_id =  '. $sdep.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.dep_id from V_DEPART t where t.dep_id =  '. $sdep.'');

                $query.=" and dep_id in (select dep_id from V_DEPART t where t.executor_par='".$dep[0]->dep_id."')";
            }
            else{
                $query.=" and dep_id = '".$sdep."'";
            }
        }
        else
        {
            $query.=" ";

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
        if ($jobid == 4) {
            $query.=" and order_employee = '". $id."'";

        }
        else
        {
            $query.=" ";

        }
        $tenders=DB::select("SELECT * FROM V_TENDERS t WHERE 1=1 " .$query." ");
       
        foreach ($tenders as $tender) {
          $tender->pack = DB::select('select * from V_TENDER_PACK t where t.pack_tender=' . $tender->tenderid . '');
        }
        foreach ($tenders as $tender) {
            $tender->detail = DB::select('select * from v_order_detail t where t.order_id=' . $tender->order_id . ' ');

        }
        foreach ($tenders as $tender) {
            $tender->contract = DB::select('select * from v_contracts t where rownum = 1 and t.tenderid=' . $tender->tenderid . '');

        }
       
        return view('report.tender',compact('tenders','types','tendertype','stendertype','sselection','sdep','deps'));
    }

    public function reportTenderDetail(Request $request)
    {
        $jobid= Auth::user()->jobid;
        $id= Auth::user()->id;
        $query = "";
        if ($jobid == 4) {
            $query.=" and order_employee = '". $id."'";

        }
        else
        {
            $query.=" ";

        }

        $tender=DB::select("select * from V_TENDERS where 1=1  " .$query."");
        return view('report.tenderdetail',compact('tender'));
    }
    public function reportContract(Request $request)
    {
        $jobid= Auth::user()->jobid;
        $id= Auth::user()->id;
        $query = "";
        $query1 = "";
        $sdep ='';
        $stendertype = '';
        $sselection = '';
        $sorder_budget_source = '';

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
            $query1 = "and dep_id = '".$sdep."'";

        }
        else
        {
            $query1.=" ";

        }
        if ($sorder_budget_source!=NULL && $sorder_budget_source !=0) {
            $query.=" and order_budget_source = '".$sorder_budget_source."'";
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
        if ($jobid == 4) {
            $query.=" and order_employee = '". $id."'";

        }
        else
        {
            $query.=" ";

        }

        $contracts=DB::select("SELECT * FROM v_contracts t where 1=1  " .$query."");
        foreach ($contracts as $contract) {
            $contract->detail = DB::select('select * from v_order_detail t where  t.order_id=' . $contract->order_id . '' . $query1. '');

        }
        return view('report.contract',compact('contracts','dep','type','tendertype','stendertype','sselection','sdep','sorder_budget_source'));
    }
    public function reportProgress(Request $request)
    {
        $jobid= Auth::user()->jobid;
        $id= Auth::user()->id;
        $query = "";
        $query1 = "";
        $sdep ='';
        $stendertype = '';
        $sselection = '';
        $sorder_budget_source = '';

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
            $query1 = "and dep_id = '".$sdep."'";

        }
        else
        {
            $query1.=" ";

        }
        if ($sorder_budget_source!=NULL && $sorder_budget_source !=0) {
            $query.=" and order_budget_source = '".$sorder_budget_source."'";
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
        if ($jobid == 4) {
            $query.=" and order_employee = '". $id."'";

        }
        else
        {
            $query.=" ";

        }

        $tenders=DB::select("SELECT * FROM V_TENDERS t WHERE 1=1 " .$query." ");
       
        foreach ($tenders as $tender) {
          $tender->pack = DB::select('select * from V_TENDER_PACK t where t.pack_tender=' . $tender->tenderid . '');
        }
        foreach ($tenders as $tender) {
            $tender->detail = DB::select('select * from v_order_detail t where t.order_id=' . $tender->order_id . '');

        }
        foreach ($tenders as $tender) {
            $tender->contract = DB::select('select * from v_contracts t where rownum = 1 and t.tenderid=' . $tender->tenderid . '');

        }
        foreach ($tenders as $tender) {
            $tender->komiss = DB::select('select * from V_TENDER_KOMISS t where t.komiss_tender=' . $tender->tenderid . '');

        }
        return view('report.progress',compact('tenders','dep','type','tendertype','stendertype','sselection','sdep','sorder_budget_source'));
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
    public function reportOrder(Request $request)
    {
        $jobid= Auth::user()->jobid;
        $id= Auth::user()->id;
        $query = "";
        $ostate= DB::select("select * from CONST_ORDER_STATE t order by state_name");
        $source= DB::select("select * from CONST_ORDER_BUDGET_SOURCE t");
        $selection= DB::select("select * from CONST_ORDER_SELECTIONS t");
        $dep= DB::select("select * from MEASINST.V_DEPART t");
        $unit= DB::select("select * from CONST_UNIT t");
        $count_order= DB::select("select count(order_id) as count from V_ORDERS t")[0];
        $currency= DB::select("select * from CONST_CURRENCY t order by currency_id");
        $type= DB::select("select * from CONST_TENDER_TYPES t");
        $tendertype= DB::select("select * from CONST_CONTRACT_TYPES t");
        $tenderstate= DB::select("select t.* from CONST_TENDER_STATE t");
        $employee= DB::select("select t.* from V_USERS t where jobcode <5 order by first_name");
        $contract_type= DB::select("select t.* from CONST_CONTRACT_TYPES t");
        if ($jobid == 4) {
            $query.=" and order_employee = '". $id."'";

        }
        else
        {
            $query.=" ";

        }
        $order= DB::select("select * from V_ORDERS t where 1=1  $query");

      
        return view('report.order',compact('dep','ostate','source','selection','unit','order','type','tendertype','tenderstate','employee','currency','contract_type','count_order'));
    }
}
