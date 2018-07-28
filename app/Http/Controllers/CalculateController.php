<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Attend;
use App\employeeloyee;
use App\Calculate;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CalculateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDataListGaji()
    {
        $gaji = Calculate::with('pegawai')->get();

        //dd($gaji);

        return DataTables::of($gaji)
            ->addColumn('nama', function ($gaji) {
                return $gaji->pegawai->user->name;
            })
            ->addColumn('periode', function ($gaji) {
                $dt_object =Carbon::createFromFormat('!m', $gaji->calculate_period);
                return '<div class="text-center">'.$dt_object->format('F').'</div>';
            })
            ->addColumn('total_masuk', function ($gaji) {
                return '<div class="text-center">'.$gaji->calculate_attend.'</div>';
            })
            ->addColumn('total_lembur', function ($gaji) {
                return '<div class="text-center">'.$gaji->calculate_overtime.'</div>';  
            })
            ->addColumn('gaji_pokok', function ($gaji) {
                return '<div class="text-right">'. number_format($gaji->calculate_gapok,0) .'</div>';
            })
            ->addColumn('tunjangan', function ($gaji) {
                return '<div class="text-right">'. number_format($gaji->calculate_allowance,0) .'</div>';
            })
            ->addColumn('lemburan', function ($gaji) {
                return '<div class="text-right">'. number_format($gaji->calculate_overtime_amount,0).'</div>';
            })
            ->addColumn('total_gaji', function ($gaji) {
                return '<div class="text-right">'. number_format($gaji->calculate_gapok+$gaji->calculate_allowance+$gaji->calculate_overtime_amount,0) .'</div>';
                //return '';
            })
            ->addColumn('action', function ($gaji) {
                return '<div class="text-center"><a href="preview_slip/'.$gaji->id.'" target="_blank" onclick="attendOut('.$gaji->id.')" ><i class="fa fa-print"></i></a>
                </div>';
            })
            ->rawColumns(['nama','periode','total_masuk','total_lembur','gaji_pokok','tunjangan','lemburan','total_gaji','action'])
            ->make(true);
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

    public function list_datagaji()
    {
        $title = 'Daftar Gaji';
        $param = [
            'title' => $title,
        ];

        return view('calculates.listgaji')->with($param);
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
        $absens = DB::select('SELECT employee_id,NAME,employee_basic,employee_allowance,SUM(n+b) AS totjam,SUM(lembur) AS totlembur,
                        ((employee_basic/8)*SUM(n+b)) AS gaji,employee_allowance*SUM(lembur) AS totlembur FROM
                        (SELECT a.employee_id,c.name,b.employee_basic,b.employee_allowance,
                        CASE WHEN HOUR(CONVERT(SUBTIME(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),"1:0:0"),INT))>=8 THEN 
                        HOUR(CONVERT(SUBTIME(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),"1:0:0"),INT)) ELSE
                        0 END AS n,CASE WHEN HOUR(CONVERT(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),INT))<8 THEN 
                        HOUR(CONVERT(TIMEDIFF( a.`attend_time_out`,a.`attend_time_in`),INT)) ELSE 0 END AS b,
                        IFNULL(HOUR(CONVERT(TIMEDIFF(a.attend_overtime_end,a.attend_overtime_start),INT)),0) AS lembur
                        FROM attends a INNER JOIN employees b ON a.employee_id=b.id JOIN users c ON b.user_id=c.id
                        WHERE a.`attend_date` >='.$from_date.' AND a.`attend_date` <='.$to_date.' ) AS X GROUP BY employee_id ' );

        dd($absens);
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
