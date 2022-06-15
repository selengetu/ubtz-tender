<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class DepController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function dep()
    {
        $usr_lvl=Auth::user()->userlevel;
        $usr_depid=Auth::user()->depid; 
        $parent='';
      
            $dep= DB::select("select * from EXAMUBTZ.V_DEPART t ");
        return view('const.dep',compact('dep'));
    }
    public function saveDep(Request $request)
    {
        $bindings = [
            'flg'  =>  $request->flg,
            'v_hid'  => $request->hid,
            'v_department_name'  => $request->department_name,
            'v_department_abbr'  => $request->department_abbr,
            'v_department_name_ru'  => '',
            'v_department_par'  =>$request->p_abbr,
            'v_department_type'  => 1,
            'v_balance_code'  => $request->balance_code,
            'v_orderid'  => 0,
            'v_usid'=>Auth::user()->id,
            ];
     
            $rep = DB::executeProcedure('pr_depart', $bindings);
            return back();
    }
    public function getDep($hid)
    {
        return DB::select("select * from V_DEPART t where t.hid='$hid'");
    }

}
