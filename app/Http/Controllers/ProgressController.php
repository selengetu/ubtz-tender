<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ProgressController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function saveProgress(Request $request)
    {
        $id= Auth::user()->id;
        if($request->progress_id ==  null){
            DB::insert("insert into tender_progress
            (progress_state, progress_date, progress_comment, progress_tender, ADDED_USER)
            values
            ('$request->progress_state', '$request->progress_date','$request->progress_comment','$request->progress_tender', '$id')");
            
              }
                else{
        
                    $orders = DB::table('tender_progress')
                    ->where('progress_id', $request->progress_id)
                    ->update(['progress_state' => $request->progress_state,'progress_date' => $request->progress_date,'progress_comment' => $request->progress_comment, 'progress_tender' =>  $request->progress_tender]);        
                }

        return 1;
    }
    
    public function getprogresses($hid)
    {
        return DB::select("select * from V_TENDER_PROGRESS t where t.progress_tender='$hid'");
    }
    public function getprogress($hid)
    {
        return DB::select("select * from V_TENDER_PROGRESS t where t.progress_id='$hid'");
    }
    
    public function delProgress($hid)
    {
        $user = DB::table('TENDER_PROGRESS')
        ->where('progress_id',$hid)
        ->update(['is_active' => 0]);
            return 1;
    }
}
