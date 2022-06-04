<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;
use Session;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function savePerson(Request $request)
    {
        //DB::getPdo()->lastInsertId();
       // dd($request);
       $email=$request->email;
       /*$cnt=DB::select("select count(*) cnt from users u where u.email='$email'")[0]->cnt;
       if($cnt==0){
            $perid = DB::select("select seq_id.nextval as perid from dual")[0]->perid;
            DB::insert("insert into person
            ( perid,fname, lname, registerno, depid, jobcode, jobname, jobabbr, phonenumber,  mailadd)
        values
            ($perid, '$request->fname', '$request->lname', '$request->registerno', $request->depid, 0, '$request->jobname', '$request->jobname', $request->phonenumber, '$request->mailadd')");

            $pass=Hash::make($request->password);
            DB::insert("insert into users
            ( name, email, password,  perid, userlevel)
        values
            ( '$request->fname', '$request->email',  '$pass', $perid, $request->userlevel)");
       } else {
           dd('email duplicate');
       }*/
      // dd($request);
      $cnt=DB::select("select count(*) cnt from users t where t.email='$email'")[0]->cnt;
      if($cnt>0){
        return redirect('person')->with('message','Хэрэглэгч давхардаж байна!');
      }
        $fileName='';
        $fileModel = new File;
        if($request->file()) {
            $imageTempName = $request->file->getPathname();
            $extension = $request->file->getClientOriginalExtension();
            $fileName = time().'.'.$request->file->extension();
            $path =base_path().'/public/img/';
            $request->file->move($path , $fileName, $extension );

        }
       $bindings = [
        'flg'  =>  $request->flg,
        'v_hid'  => $request->hid,
        'v_fname'  => $request->fname,
        'v_lname'  => $request->lname,
        'v_registerno'  => $request->registerno,
        'v_depid'  => $request->depid,
        'v_workname'  => $request->workname,
        'v_jobcode'  =>  $request->jobcode,
        'v_jobabbr'  => $request->jobname,
        'v_jobabbr_s'  => $request->jobname_abbr,
        'v_phonenumber'  => $request->phonenumber,
        'v_sex'  => 0,
        'v_mailadd'  => $request->mailadd,
        'v_picture'  => $fileName,
        'v_userlevel'  => $request->v_userlevel,
        'v_usid'  => Auth::user()->perid,
        ];

        try {
            $rep = DB::executeProcedure('pr_person', $bindings);
            return 1;
          } catch (\Exception $e) {
              return 'Цахим хаяг эсвэл Регистер № давхардаж байна. '.$e->getMessage();
          }


    }
    public function person()
    {
        $lvl = Auth::user()->userlevel;
        $userdep = Auth::user()->depid;

        $dep=DB::select("select * from EXAMUBTZ.v_depart");
        $user=DB::select("select * from USERS"); // root ULAANBAATAR RAILWAY -->enenees yalgaatai      
        $jobs=DB::select("select * from CONST_JOB");
       
        return view('const.person',compact('dep','jobs','user'));
    }
    public function job()
    {
        $jobs=DB::select("select * from CONST_JOB");
        return view('const.job',compact('jobs'));
    }
    public function getJobs($hid=0)
    {
        if(strlen($hid)>1){
            return DB::select("select * from CONST_JOB where jobcode='$hid'");
        } else {
            return DB::select("select * from CONST_JOB");
        }

    }

    public function getPerson($hid)
    {
        return DB::select("select * from USERS t where t.id='$hid'");
    }

    public function perDel(Request $request)
    {
        $bindings = [
            'flg'  =>  '2',
            'v_hid'  => $request->hid,
            'v_fname'  => '',
            'v_lname'  =>  '',
            'v_registerno'  =>  '',
            'v_depid'  =>  '',
            'v_workname'  =>  '',
            'v_jobcode'  =>   '',
            'v_jobabbr'  =>  '',
            'v_jobabbr_s'  => '',
            'v_phonenumber'  =>  '',
            'v_sex'  => 0,
            'v_mailadd'  =>  '',
            'v_picture'  =>  '',
            'v_userlevel'  =>  '',
            'v_usid'  => Auth::user()->perid,
            ];
            try {
                $rep = DB::executeProcedure('pr_person', $bindings);
            } catch (\Exception $e) {
                return 'Алдаа гарлаа. '.$e->getMessage();
            }
            return 1;
    }

    public function config()
    {
        $uid=Auth::id();
        $cnt=DB::select("select count(*) cnt from USERS u, v_person p
        where p.PERID=u.perid and u.id=$uid")[0]->cnt;
        if($cnt>0){
            $info=DB::select("select u.id,u.email,p.*,
            case when p.userlevel=1 then 'Админ'
              when p.userlevel=2 then 'Дэд админ'
              when p.userlevel=3 then 'Менежир'
              when p.userlevel=4 then 'Хэрэглэгч' end as level_name from USERS u, v_person p where p.PERID=u.perid and u.id=$uid")[0];
            return view('const.config',compact('info'));
        } else {
            dd('Амжилтгүй боллоо. мэдээлэл олдсонгүй');
        }
    }
    public function passw(Request $request)
    {

        $uid=Auth::id();
        $current_password = Auth::User()->password;
        if(Hash::check($request->pass1, $current_password))
        {
            if($request->pass2==$request->pass3)
            {
                if (strlen($request->pass2) <= 8) {
                    Session::flash('message','Таны нууц үг 8 тэмдэгтээс илүү байх ёстой.');
                    return redirect('config');
                }

                if(!preg_match("#[0-9]+#",$request->pass2)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Number!";
                    Session::flash('message','Таны нууц үг дор хаяж 1 тоо агуулах ёстой.');
                    return redirect('config');
                }
                if(!preg_match("#[A-Z]+#",$request->pass2)) {
                    Session::flash('message','Таны нууц үг дор хаяж 1 том үсэг агуулах ёстой.');
                    return redirect('config');

                }
                if(!preg_match("#[a-z]+#",$request->pass2)) {
                    Session::flash('message','Таны нууц үг дор хаяж 1 жижиг үсэг агуулах ёстой.');
                    return redirect('config');

                }
                if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $request->pass2)) {
                    Session::flash('message','Таны нууц үг дор хаяж 1 тэмдэгт агуулах ёстой.');
                    return redirect('config');
                }
                else{
                    $newpass=Hash::make($request->pass2);
                    $cnt = DB::update("update users set password='$newpass' where id=$uid");
                    Session::flash('message','Амжилттай боллоо.');
                    return redirect('config');
                }

            }
            else
                {
                    Session::flash('message','Баталгаажуулах нууц үг тохирсонгүй.');
                    return redirect('config');
                }
        }
        else
        {
            Session::flash('message','Амжилтгүй. Одоогийн нууц үг тохирсонгүй.');
            return redirect('config');
        }

    }
 

}
