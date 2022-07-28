<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class KomissController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function saveKomiss(Request $request)
    {
        $id= Auth::user()->id;
        if($request->komiss_id ==  null){
            DB::insert("insert into tender_komiss
            (komiss_employee, komiss_job, komiss_date, komiss_comment, komiss_tender)
            values
            ('$request->komiss_employee', '$request->komiss_job', TO_DATE('$request->komiss_date', 'yyyy-mm-dd'),'$request->komiss_comment','$request->komiss_tender')");
            
              }
                else{
        
                    $orders = DB::table('tender_komiss')
                    ->where('komiss_id', $request->komiss_id)
                    ->update(['komiss_employee' => $request->komiss_employee,'komiss_job' => $request->komiss_job,'komiss_date' => $request->komiss_date,'komiss_comment' => $request->komiss_comment]);        
                }

        return 1;
    }
    
    public function getkomisses($hid)
    {
        return DB::select("select * from V_TENDER_KOMISS t where t.komiss_tender='$hid'");
    }
    public function getkomiss($hid)
    {
        return DB::select("select * from V_TENDER_KOMISS t where t.komiss_id='$hid'");
    }
   
}
