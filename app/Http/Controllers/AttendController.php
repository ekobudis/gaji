<?php

namespace App\Http\Controllers;

use Auth;
use App\Attend;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AttendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllAttend()
    {
        $absen = Attend::with('pegawai')->get();

        return DataTables::of($absen)
            ->addColumn('nama', function ($absen) {
                return $absen->pegawai->emp_name;
            })
            ->addColumn('tgl_masuk', function ($absen) {
                return '<div class="text-center">'.Carbon::parse($absen->attend_date)->format('d-M-y').'</div>';
            })
            ->addColumn('jam_masuk', function ($absen) {
                return '<div class="text-center">'.Carbon::parse($absen->attend_time_in)->format('H:i').'</div>';
            })
            ->addColumn('jam_keluar', function ($absen) {
                if($absen->attend_time_out != null){
                    return '<div class="text-center">'.Carbon::parse($absen->attend_time_out)->format('H:i').'</div>';
                }else{
                    return '<div class="text-center"></div>';
                }  
            })
            ->addColumn('total_masuk', function ($absen) {
                if($absen->attend_time_out != null){
                    $masuk = Carbon::parse($absen->attend_time_in);
                    $keluar = Carbon::parse($absen->attend_time_out);
                    $total = $keluar->diffInHours($masuk);
                    $menit = $keluar->diffInMinutes($masuk);
                    if($total>8){
                        $jam = $total-1;
                    }else{
                        $jam = $total;
                    }
                    
                    return '<div class="text-center">'.$jam .'</div>';
                }else{
                    return '<div class="text-center"></div>';
                }
                //return '';
            })
            ->addColumn('masuk_lembur', function ($absen) {
                if($absen->attend_overtime_start != null){
                    return '<div class="text-center">'.Carbon::parse($absen->attend_overtime_start)->format('H:i').'</div>';
                }else{
                    return '<div class="text-center"></div>';
                }
            })
            ->addColumn('keluar_lembur', function ($absen) {
                if($absen->attend_overtime_end != null){
                    return '<div class="text-center">'.Carbon::parse($absen->attend_overtime_end)->format('H:i').'</div>';
                }else{
                    return '<div class="text-center"></div>';
                }
            })
            ->addColumn('durasi_lembur', function ($absen) {
                if($absen->attend_overtime_end != null){
                    $lembur_masuk = Carbon::parse($absen->attend_overtime_start);
                    $lembur_keluar = Carbon::parse($absen->attend_overtime_end);
                    $lembur_total = $lembur_keluar->diffInHours($lembur_masuk);
                    $lembur_menit = $lembur_keluar->diffInMinutes($lembur_masuk);

                    return '<div class="text-center">'.$lembur_total .'</div>';
                }else{
                    return '<div class="text-center"></div>';
                }
                //return '';
            })
            ->addColumn('action', function ($absen) {
                return '<div class="text-center"><a href="#" onclick="attendOut('.$absen->id.')" ><i class="fa fa-edit"></i></a>
                <a href="#" onclick="showDelete('.$absen->id.')"><i class="fa fa-trash"></i></a>    
                <a href="#" onclick="JamMasukLembur('.$absen->id.')"><i class="fa fa-calendar-check-o"></i></a>
                <a href="#" onclick="JamKeluarLembur('.$absen->id.')"><i class="fa fa-calendar-times-o"></i></a></div>';
            })
            ->rawColumns(['nama','tgl_masuk','jam_masuk','jam_keluar','total_masuk','masuk_lembur','keluar_lembur','durasi_lembur','action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Absensi Pegawai';
        $attend = Attend::with('pegawai')->get();
        $params = [
            'title' => $title,
            'attend' => $attend,
        ];

        return view('attends.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Absensi Pegawai';
        $attend = new Attend;
        $emp = Employee::pluck('emp_name','id')->toArray();
        $params = [
            'title' => $title,
            'attend' => $attend,
            'emp' => $emp,
        ];

        return view('attends.form')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Carbon::setLocale('id');

        $errors = $this->validate($request,[
            'emp_id' => 'required',
        ]);
        
        $tgl = Carbon::now();

        $absen = new Attend();
        $absen->emp_id = request('emp_id');
        $absen->attend_date = $tgl;
        $absen->attend_time_in = Carbon::now()->format('H:i');
        $absen->save();

        return redirect()->route('attends.index')->with('success','Absen berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function show(Attend $attend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function edit(Attend $attend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $absen = Attend::findOrFail($id);
        $absen->attend_time_out = request('attend_time_out');
        $absen->save();

        //return redirect()->route('attends.index')->with('success','Absen keluar berhasil di simpan');
    }

    public function updateLembur(Request $request, $id)
    {
        $absen = Attend::findOrFail($id);
        $absen->attend_overtime_start = request('attend_overtime_start');
        $absen->attend_overtime_end = request('attend_overtime_end');
        $absen->save();

        //return redirect()->route('attends.index')->with('success','Absen keluar berhasil di simpan');
    }

    public function getDetailEmpLembur(Request $request, $id)
    {
        $absen = Attend::findOrFail($id);

        return response()->json($absen);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attend $attend)
    {
        //
    }
}