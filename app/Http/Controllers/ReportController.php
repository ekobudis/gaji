<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use PDF;
use App\Advance;
use App\Position;
use App\Department;
use App\Project;
use App\Employee;
use App\Attend;
use App\Calculate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDepartmentPreview(Request $request)
    {
        $title = 'Daftar Departemen';

        $department = Department::all();

        //$setting = Setting::findOrFail(1);

        $params = [
            'title'  => $title,
            'department' => $department,
        ];

        $pdf = PDF::loadView('departments.pdf', [
            'title'  => $title,
            'department' => $department
        ]);
        
        return view('departments.pdf')->with($params);
        //return $pdf->inline('departments.pdf');
    }

    public function getPositionPreview(Request $request)
    {
        $title = 'Daftar Jabatan';

        $position = Position::all();

        //$setting = Setting::findOrFail(1);

        $params = [
            'title'  => $title,
            'position' => $position,
        ];

        $pdf = PDF::loadView('positions.pdf', [
            'title'  => $title,
            'position' => $position
        ]);
        
        return view('positions.pdf')->with($params);
        //return $pdf->inline('positions.pdf');
    }

    public function getProjectPreview(Request $request)
    {
        $title = 'Daftar Proyek';

        $project = Project::all();

        //$setting = Setting::findOrFail(1);

        $params = [
            'title'  => $title,
            'project' => $project,
        ];

        $pdf = PDF::loadView('projects.pdf', [
            'title'  => $title,
            'project' => $project
        ]);
        
        return view('projects.pdf')->with($params);
        //return $pdf->inline('projects.pdf');
    }

    public function getEmployeePreview(Request $request)
    {
        $title = 'Daftar Pegawai';

        $pegawai = Employee::all();

        //$setting = Setting::findOrFail(1);

        $params = [
            'title'  => $title,
            'pegawai' => $pegawai,
        ];

        $pdf = PDF::loadView('employees.pdf', [
            'title'  => $title,
            'pegawai' => $pegawai
        ]);
        
        return view('employees.pdf')->with($params);
        //return $pdf->inline('employees.pdf');
    }

    public function getUserPreview(Request $request)
    {
        $title = 'Daftar User';

        $users = User::all();

        //$setting = Setting::findOrFail(1);

        $params = [
            'title'  => $title,
            'users' => $users,
        ];

        $pdf = PDF::loadView('users.pdf', [
            'title'  => $title,
            'users' => $users
        ]);
        
        return view('users.pdf')->with($params);
        ///return $pdf->inline('users.pdf');
    }

    public function getAbsensiPerPegawaiPreview(Request $request,$id)
    {
        $title = 'Data Absensi';

        $tgl_sekarang = Carbon::now()->format('Y-m-d');
        $tgl_awal =Carbon::create(Carbon::now()->format('Y'),Carbon::now()->format('m'),1)->format('Y-m-d');
        
        $emp = Employee::findOrFail($id);
        $absens = Attend::with('pegawai','user')->where([['employee_id','=',$id],['attend_date','>=',$tgl_awal],['attend_date','<=',$tgl_sekarang]])->get();
        //$setting = Setting::findOrFail(1);
        //dd($absens);

        $params = [
            'title'  => $title,
            'absens' => $absens,
            'emp' => $emp,
        ];

        $pdf = PDF::loadView('attends.pdfabsen', [
            'title'  => $title,
            'absens' => $absens,
            'emp' => $emp
        ]);
        
        return view('attends.pdfabsen')->with($params);
        //return $pdf->inline('attends.pdfabsen');
    }

    public function getAbsensiPegawaiPreview(Request $request)
    {
        $title = 'Daftar Absensi';

        $tgl_sekarang = Carbon::now()->format('Y-m-d');
        $tgl_awal =Carbon::create(Carbon::now()->format('Y'),Carbon::now()->format('m'),1)->format('Y-m-d');
        
        $absens = Attend::with('pegawai','user')->where([['attend_date','>=',$tgl_awal],['attend_date','<=',$tgl_sekarang]])->get();
        //$setting = Setting::findOrFail(1);

        dd($absens);
        $params = [
            'title'  => $title,
            'absens' => $absens,
        ];

        $pdf = PDF::loadView('attends.absenall', [
            'title'  => $title,
            'absens' => $absens
        ]);
        
        return view('attends.absenall')->with($params);
        //return $pdf->inline('attends.pdfabsen');
    }

    public function getAdvancedPreview(Request $request)
    {
        $title = 'Daftar Advanced';

        $advanced = Advance::all();

        $params = [
            'title'  => $title,
            'advanced' => $advanced,
        ];

        $pdf = PDF::loadView('advances.pdf', [
            'title'  => $title,
            'advanced' => $advanced
        ]);
        
        return view('advances.pdf')->with($params);
        //return $pdf->inline('advances.pdf');
    }

    public function getReportGajiPreview(Request $request)
    {
        $title = 'Laporan Gaji';

        $calculate = Calculate::with('pegawai')->get();

        $params = [
            'title'  => $title,
            'calculate' => $calculate,
        ];

        $pdf = PDF::loadView('calculates.pdf', [
            'title'  => $title,
            'calculate' => $calculate
        ]);
        
        return view('calculates.pdf')->with($params);
        //return $pdf->inline('calculates.pdf');
    }

    public function getSlipGajiPreview(Request $request,$id)
    {
        $title = 'Slip Gaji';

        $calculate = Calculate::with('pegawai')->findOrFail($id);

        //dd($calculate);
        $params = [
            'title'  => $title,
            'calculate' => $calculate,
        ];

        $pdf = PDF::loadView('calculates.slippdf', [
            'title'  => $title,
            'calculate' => $calculate
        ]);
        
        return view('calculates.slippdf')->with($params);
        //return $pdf->inline('calculates.slippdf');
    }

    public function getFormKasbonPreview(Request $request,$id)
    {
        $title = 'Form Pengajuan Pinjaman';

        $kasbons = Advance::findOrFail($id);

        $params = [
            'title' => $title,
            'kasbons' => $kasbons,
        ];

        $pdf = PDF::loadView('advances.formpdf', [
            'title'  => $title,
            'kasbons' => $kasbons,
        ]);
        
        return view('advances.formpdf')->with($params);
        //return $pdf->inline('advances.formpdf');
    }

    public function getAttendPreview(Request $request,$dari_tanggal, $sampai_tanggal)
    {
        $title = 'Daftar Absensi';

        $attends = Attend::with('pegawai')->where()->get();

        $params = [
            'title'  => $title,
            'attends' => $attends,
        ];

        $pdf = PDF::loadView('departments.pdf', [
            'title'  => $title,
            'attends' => $attends
        ]);
        
        //return view('accounts.pdf')->with($params);
        return $pdf->inline('departments.pdf');
    }
}
