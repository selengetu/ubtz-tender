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
        $count_order= DB::select("select count(order_id) as count from ORDERS t");
        $count_tender= DB::select("select count(tenderid) as count from TENDERS");
        $count_contractbegin= DB::select("select count(contractid) as count from Contracts t");
        $count_contract= DB::select("select count(contractid) as count from Contracts t where contract_end_date is not null");
        $t1= DB::select("select executor_abbr, sum(order_budget) as sum_budget,  NVL(sum(t.order_performance), '0')  as sum_performance from V_ORDER_DETAIL t group by executor_abbr");
        $t2= DB::select("select name,  count(name) as countwork from V_TENDERS t group by name");
        return view('home',compact('count_order','count_tender', 'count_contract', 'count_contractbegin', 't1', 't2'));
    }
    public function savePerson(Request $request)
    {
       $email=$request->email;

     
        $fileName='';
        $fileModel = new File;
        if($request->file()) {
            $imageTempName = $request->file->getPathname();
            $extension = $request->file->getClientOriginalExtension();
            $fileName = time().'.'.$request->file->extension();
            $path =base_path().'/public/img/';
            $request->file->move($path , $fileName, $extension );

        }
         if($request->hid ==  null){
            $cnt=DB::select("select count(*) cnt from users t where t.email='$email'")[0]->cnt;
            if($cnt>0){
              return redirect('person')->with('message','Хэрэглэгч давхардаж байна!');
            }
            DB::insert("insert into users
            (first_name,last_name, email, is_active, jobid, phone)
            values
            ('$request->first_name', '$request->last_name', '$request->email',  '$request->is_active', '$request->jobid', '$request->phone')");
            
          }
            else{
                $user = DB::table('USERS')
                ->where('id', $request->hid)
                ->update(['first_name' => $request->first_name,'last_name' => $request->last_name,'email' => $request->email,
                'is_active' => $request->is_active,'jobid' => $request->jobid,'phone' => $request->phone]);
            
            }
            return back();
    }
    public function person()
    {
        $lvl = Auth::user()->userlevel;
        $userdep = Auth::user()->depid;
        
        $state=DB::select("select * from CONST_USER_STATE");
        $dep=DB::select("select * from EXAMUBTZ.v_depart");
        $user=DB::select("select * from v_users where jobcode <5");
        $jobs=DB::select("select * from CONST_JOB");
       
        return view('const.person',compact('dep','jobs','user','state'));
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

    public function perDel($hid)
    {
        $user = DB::table('USERS')
        ->where('id',$hid)
        ->update(['is_active' => 0]);
            return 1;
    }

    public function config()
    {
        $uid=Auth::id();
        $cnt=DB::select("select count(*) cnt from V_USERS u where u.id=$uid")[0]->cnt;
        if($cnt>0){
            $info=DB::select("select * from V_USERS u where u.id=$uid")[0];
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
 
    public function passEdit($id)
    {
        $method = DB::table('users')
        ->where('id', $id)
        ->update(['password' => '$2y$10$FfacvMREjSCrcXbTYrM89uF1gJWrY3iPfsas1tAqz4pCI/n0GEDn.']);
            return 1;    
    }
}
