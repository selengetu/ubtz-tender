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
        $tender=DB::select("select * from V_TENDERS");
        return view('report.tender',compact('tender'));
    }

}
