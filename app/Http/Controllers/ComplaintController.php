<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ComplaintController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function saveComplaint(Request $request)
    {
        if($request->complaint_id ==  null){
            DB::insert("insert into tender_complaint
            (complaint_comment,complaint_date, complaint_tender, complaint_order)
            values
            ('$request->complaint_comment','$request->complaint_date', '$request->complaint_tender','$request->complaint_order')");
            
              }
                else{
        
                    $orders = DB::table('tender_complaint')
                    ->where('pack_id', $request->pack_id)
                    ->update(['complaint_comment' => $request->complaint_comment, 'complaint_date' => $request->complaint_date]);        
                }

        return 1;
    }
    
    public function getcomplaints($hid)
    {
        return DB::select("select * from TENDER_COMPLAINT t where t.complaint_order='$hid'");
    }
    public function getcomplaint($hid)
    {
        return DB::select("select * from TENDER_COMPLAINT t where t.complaint_id='$hid'");
    }
   
}
