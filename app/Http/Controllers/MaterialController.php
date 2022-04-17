<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;
class MaterialController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $datas = DB::select("select typeid, UPPER(typename) as typename from v_training_type where parentid=0");
        foreach($datas as $parent) {
            $parent->childs = DB::select('select typeid, typename as typename from v_training_type where parentid='.$parent->typeid);
            foreach($parent->childs as $child) {
                $child->files = DB::select('select trid, trainingname, traininggroup from v_training where trainingsgroup='.$child->typeid.' and depid='.Auth::user()->depid);
            }
        }
        $dep=DB::select("select * from v_depart");
        return view('material',compact('datas', 'dep'));
    }

    public function addTrainingFile(Request $request) {
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
        $order = 1;
        if( $this->procTrainingFile( $request->flg,  $request->hid, $request->title, $request->group, $request->sgroup, $fileName, $request->note, $request->depid, $order,  Auth::user()->perhid) ) {
            return back();
        }
        else {
            echo 'Add Failed<br>';
        }
    }

    public function procTrainingFile($flag, $hid, $name, $group, $sgroup, $file, $note, $dep, $order, $id) {
        $bindings = [
            'flg'  => $flag,
            'v_hid'  => $hid,
            'v_trainingname'  => $name,
            'v_traininggroup'  => $group,
            'v_trainingsgroup'  => $sgroup,
            'v_filepath'  => $file,
            'v_note'  => $note,
            'v_depid'  => $dep,
            'v_orderid'  => $order,
            'v_usid'  => Auth::user()->perhid,
        ];
        return DB::executeProcedure('pr_training_file', $bindings);
    }

    public function showTrainingFile($hid) {
        $files = DB::table('v_training')->where('trid',$hid)->get('filepath');
        if( count($files)==1 ) {
            return response()->file('assets/upload/'.$files[0]->filepath);
        }
        else {
            echo 'wrong number of results: '.count($files);
        }
    }
    public function delmat(Request $request)
    {
        $bindings = [
            'flg'  => 2,
            'v_hid'  => $request->hid,
            'v_trainingname'  => '',
            'v_traininggroup'  => 1,
            'v_trainingsgroup'  => 1,
            'v_filepath'  => 1,
            'v_note'  => '',
            'v_depid'  => '',
            'v_orderid'  => 1,
            'v_usid'  => Auth::user()->perhid,
 
        ];
            try {
                $rep = DB::executeProcedure('pr_training_file', $bindings);
                return 1;   
            } catch (\Exception $e) {
                return 'Алдаа гарлаа. '.$e->getMessage();
            }
         
    }
    // public function editTrainingFile() {
    //     $hid = '34398f85c07096c8aba4f5ee0594dcdd';
    //     $trainingname = 'proc test 123';
    //     $group = 1;
    //     $sgroup = 3;
    //     $file = '00.pdf';
    //     $note = 'note test 123';
    //     $dep = 0;
    //     $order = 1;
    //     if( $this->procTrainingFile(1, $hid, $trainingname, $group, $sgroup, $file, $note, $dep, $order) ) {
    //         echo 'Edit Success<br>';
    //     }
    //     else {
    //         echo 'Edit Failed<br>';
    //     }
    // }

    // public function removeTrainingFile() {
    //     $hid = 'c0124ca6864cf3cf1f631a6496ff987a';
    //     if( $this->procTrainingFile(2, $hid, '', 0, 0, '', '', 0, 0) ) {
    //         echo 'Delete Success<br>';
    //     }
    //     else {
    //         echo 'Delete Failed<br>';
    //     }
    // }
}
