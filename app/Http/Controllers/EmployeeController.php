<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Department;
use App\Employee;
use App\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllEmployee()
    {
        $emp = Employee::all();

        return response()->json($emp);
    }

    public function empAutoNumber(Request $request,$department,$tanggal)
    {
        $prefix = date('Y',strtotime($tanggal));
        $thn = date('y',strtotime($tanggal));
        $now =  \Carbon\Carbon::now();

        $dept_id = Department::findOrFail($department);
        
        $autonomos = DB::table('employees')
            ->select('id','emp_id')
            ->where('dept_id','=',$dept_id->id)
            ->whereYear('emp_join_date','=',$prefix)
            ->latest()
            ->take(1)
            ->first();
        
        //dd($autonomos);

        if($autonomos == null)
        {
            $n = 1;
            //dd($n);
            $tmp = sprintf('%03s', $n);
            $nomer = $dept_id->dept_code.$thn.$tmp;
            //dd($nomer);
            $id = 0;

            $data = array('emp_id'=>$nomer,'id'=>$id);

            return response()->json($data);

        }else{
            $next_nomers =  DB::table('employees')
            ->select('id','emp_id')
            ->where('dept_id','=',$dept_id->id)
            ->whereYear('emp_join_date','=',$prefix)
            ->latest()
            ->take(1)
            ->first();
            //Employee::select('id','emp_id')->where([['sale_userlock',0],['user_id',Auth::user()->id]])->latest()->take(1)->first();
            if($next_nomers->emp_id != null){
                //buka transaksi dan loop data.. utk open transaksi baru harus di close dl transaksi yg open. bisa via hold atau bayar
                $nexts = substr($next_nomers->emp_id,-3);
                //dd($nexts);
                $n = str_replace($dept_id->dept_code.$thn, "", $nexts) + 1;
                //dd($n);
                $tmp = sprintf('%03s', $n);
                //dd($tmp);
                $nomer = $dept_id->dept_code.$thn.$tmp;
                $id = $next_nomers->id;

                $data = array('emp_id'=>$nomer,'id'=>$id);

                return response()->json($data);
            }    
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        $params = [
            'title' => 'Daftar Pegawai',
            'employees' => $employees,
        ];

        return view('employees.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = new Employee;
        $dept = Department::pluck('dept_name','id')->toArray();
        $post = Position::pluck('position_name','id')->toArray();
        $params = [
            'title' => 'Pegawai Baru',
            'emp' => $emp,
            'post' => $post,
            'dept' => $dept,
        ];

        return view('employees.form')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $erros = $this->validate($request,[
            'emp_id' => 'required',
            'emp_name' => 'required'
        ]);

        $emp = new Employee();
        $emp->emp_id =  $request->emp_id;
        $emp->emp_name =  $request->emp_name;
        $emp->emp_birthdate =  $request->emp_birthdate;
        $emp->emp_join_date =  $request->emp_join_date;
        $emp->dept_id =  $request->dept_id;
        $emp->position_id =  $request->position_id;
        $emp->emp_basic =  $request->emp_basic;
        $emp->emp_allowance =  $request->emp_allowance;
        $emp->user_id = Auth::user()->id;
        $emp->save();

        return redirect()->route('employees.index')->with('success','Pegawai berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emp = Employee::findOrFail($id);
        $dept = Department::pluck('dept_name','id')->toArray();
        $post = Position::pluck('position_name','id')->toArray();
        $params = [
            'title' => 'Edit Pegawai',
            'emp' => $emp,
            'post' => $post,
            'dept' => $dept,
        ];

        return view('employees.form')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emp = Employee::findOrFail($id);
        $emp->emp_id =  $request->emp_id;
        $emp->emp_name =  $request->emp_name;
        $emp->emp_birthdate =  $request->emp_birthdate;
        $emp->emp_join_date =  $request->emp_join_date;
        $emp->dept_id =  $request->dept_id;
        $emp->position_id =  $request->position_id;
        $emp->emp_basic =  $request->emp_basic;
        $emp->emp_allowance =  $request->emp_allowance;
        $emp->save();

        return redirect()->route('employees.index')->with('success','Pegawai berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::findOrFail($id);
        $emp->delete();

        return redirect()->route('employees.index')->with('success','Pegawai berhasil di hapus');        
    }
}
