<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Attend;
use App\Employee;
use App\Calculate;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Perhitungan Gaji';
        $payrolls = Calculate::all();
        
        $param = [
            'title' => $title,
            'payrolls' => $payrolls,
        ];

        return view('calculates.index')->with($param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proses = new Calculate;
        $bulans = Helper::getBulan();
        $title = 'Proses Penghitungan Gaji';

        $param = [
            'title' => $title,
            'proses' => $proses,
            'bulans' => $bulans,
        ];

        return view('calculates.form')->with($param);
    }

    public function getDataAbsensi($dari_tanggal, $sampai_tanggal)
    {
        $from_date =  Carbon::parse($dari_tanggal)->format('Y-m-d');
        $to_date =  Carbon::parse($sampai_tanggal)->format('Y-m-d');

        //dd($from_date);
        $absens = DB::select('SELECT a.emp_id,b.emp_name,b.emp_basic,b.emp_allowance,
                CASE WHEN HOUR(CONVERT(SUBTIME(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),"1:0:0"),INT))>=8 THEN 
                HOUR(CONVERT(SUBTIME(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),"1:0:0"),INT)) ELSE
                0 END AS n,CASE WHEN HOUR(CONVERT(SUBTIME(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),"1:0:0"),INT))<8 THEN 
                HOUR(CONVERT(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),INT)) ELSE 0 END AS b,
                IFNULL(HOUR(CONVERT(TIMEDIFF(a.attend_overtime_end,a.attend_overtime_start),INT)),0) AS lembur
                FROM attends a INNER JOIN employees b ON a.emp_id=b.id
                WHERE a.`attend_date` >='.$from_date.' AND a.`attend_date` <='.$to_date.' ');

        //dd($absens);
        return response()->json($absens);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function show(Calculate $calculate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function edit(Calculate $calculate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calculate $calculate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calculate $calculate)
    {
        //
    }
}
