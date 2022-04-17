<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;
class InfoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        $info=DB::select("select * from V_NEWS order by infoid");
        return view('Info',compact('info'));
    }

    public function addInfo(Request $request) {
        $fileModel = new File;
        
        if($request->file()) {
            $imageTempName = $request->file->getPathname();
            $extension = $request->file->getClientOriginalExtension();
            $fileName = time().'.'.$request->file->extension(); 
            $path =base_path().'/public/assets/upload/';
            $request->file->move($path , $fileName, $extension );
        }
        else{
            $fileName ='';
        }
        $flag = $request->flg;
        $hid = $request->hid;
        $title = $request->infotitle;
        $news = $request->infonews;
        $type = $request->infotype;
        $file = $fileName;
        $dep = 0;
        $id= Auth::user()->perhid;

        if( $this->procInfo($flag,$hid, $title, $news, $type, $dep, $file, $id) ) {
            echo 'Add Success<br>';
            
        }
        else {
            echo 'Add Failed<br>';
        }
        return back();
    }
    public function getInfo($hid)
    {
        return DB::select("select * from V_NEWS t where t.infoid='$hid'");
    }


    public function removeInfo(Request $request)
        {
            $bindings = [
                'flg'  => 2,
                'v_hid'  => $request->hid,
                'v_infotitle'  => '',
                'v_infonews'  => '',
                'v_infotype'  => '',
                'v_depid'  => '',
                'v_infofile'  =>'',
                'v_usid'  => Auth::user()->perhid,
     
            ];
                try {
                    $rep = DB::executeProcedure('pr_infonews', $bindings);
                    return 1;   
                } catch (\Exception $e) {
                    return 'Алдаа гарлаа. '.$e->getMessage();
                }
             
        
    }

    public function procInfo($flag, $hid, $title, $news, $type, $dep, $file, $id) {
        $bindings = [
            'flg'  => $flag,
            'v_hid'  => $hid,
            'v_infotitle'  => $title,
            'v_infonews'  => $news,
            'v_infotype'  => $type,
            'v_depid'  => $dep,
            'v_infofile'  => $file,
            'v_usid'  => $id,
        ];
        return DB::executeProcedure('pr_infonews', $bindings);
    }

}
