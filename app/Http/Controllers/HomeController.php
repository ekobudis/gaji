<?php

namespace App\Http\Controllers;

//use Auth;
use Carbon\Carbon;
use App\Employee;
use App\Attend;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        return view('dashboard');
    }

    public function absensi()
    {
        $user = Auth::user()->id;
        $tgl_sekarang = Carbon::now()->format('Y-m-d');
        $tgl_awal =Carbon::create(Carbon::now()->format('Y'),Carbon::now()->format('m'),1)->format('Y-m-d');
        //dd($tgl_awal);
        $emp = Employee::where('user_id','=',Auth::user()->id )->first();
        $absens = Attend::with('pegawai','user')->where([['employee_id','=',$emp->id],['attend_date','>=',$tgl_awal],['attend_date','<=',$tgl_sekarang]])->get();
        //dd($absens);
        $absen_hari_ini = Attend::where([['attend_date','=',$tgl_sekarang],['employee_id','=',$emp->id]])->get()->first();
        if($absen_hari_ini == null){
            $attend = new Attend;
        }else{
            $attend =Attend::where([['attend_date','=',$tgl_sekarang],['employee_id','=',$emp->id]])->get()->first();
        }
        
        $params = [
            'emp' => $emp,
            'tgl_awal' => $tgl_awal,
            'tgl_sekarang' => $tgl_sekarang,
            'absens' => $absens,
            'attend' => $attend,
        ];
        return view('attends.absen')->with($params);
    }
}
