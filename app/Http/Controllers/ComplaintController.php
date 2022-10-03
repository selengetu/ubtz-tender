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
        $id= Auth::user()->id;
        if($request->complaint_id ==  null){
            DB::insert("insert into tender_complaint
            (complaint_comment,complaint_date, complaint_tender, complaint_order, ADDED_USER)
            values
            ('$request->complaint_comment','$request->complaint_date', '$request->complaint_tender','$request->complaint_order', '$id')");
            
              }
                else{
        
                    $orders = DB::table('tender_complaint')
                    ->where('complaint_id', $request->complaint_id)
                    ->update(['complaint_comment' => $request->complaint_comment, 'complaint_date' => $request->complaint_date]);        
                }

        return 1;
    }
    
    public function getcomplaints($hid)
    {
        return DB::select("select * from V_TENDER_COMPLAINT t where t.complaint_tender='$hid'");
    }
    public function getcomplaint($hid)
    {
        return DB::select("select * from V_TENDER_COMPLAINT t where t.complaint_id='$hid'");
    }
    public function delComplaint($hid)
    {
        $user = DB::table('TENDER_COMPLAINT')
        ->where('complaint',$hid)
        ->update(['is_active' => 0]);
            return 1;
    }
   
}
