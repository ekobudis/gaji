<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Role;
use App\Department;
use App\Position;
use App\Employee;
use Carbon\Carbon;
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
            ->select('id','employee_code')
            ->where('department_id','=',$dept_id->id)
            ->whereYear('employee_join_date','=',$prefix)
            ->latest()
            ->take(1)
            ->first();
        
        //dd($autonomos);

        if($autonomos == null)
        {
            $n = 1;
            //dd($n);
            $tmp = sprintf('%03s', $n);
            $nomer = $dept_id->department_code.$thn.$tmp;
            //dd($nomer);
            $id = 0;

            $data = array('employee_code'=>$nomer,'id'=>$id);

            return response()->json($data);

        }else{
            $next_nomers =  DB::table('employees')
            ->select('id','employee_code')
            ->where('department_id','=',$dept_id->id)
            ->whereYear('employee_join_date','=',$prefix)
            ->latest()
            ->take(1)
            ->first();
            //Employee::select('id','emp_id')->where([['sale_userlock',0],['user_id',Auth::user()->id]])->latest()->take(1)->first();
            if($next_nomers->employee_code != null){
                //buka transaksi dan loop data.. utk open transaksi baru harus di close dl transaksi yg open. bisa via hold atau bayar
                $nexts = substr($next_nomers->employee_code,-3);
                //dd($nexts);
                $n = str_replace($dept_id->department_code.$thn, "", $nexts) + 1;
                //dd($n);
                $tmp = sprintf('%03s', $n);
                //dd($tmp);
                $nomer = $dept_id->department_code.$thn.$tmp;
                $id = $next_nomers->id;

                $data = array('employee_code'=>$nomer,'id'=>$id);

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
        $dept = Department::pluck('department_name','id')->toArray();
        $post = Position::pluck('position_name','id')->toArray();
        $roles = Role::get();
        $params = [
            'title' => 'Pegawai Baru',
            'emp' => $emp,
            'post' => $post,
            'dept' => $dept,
            'roles' => $roles,
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
            'employee_code' => 'required',
            'employee_name' => 'required'
        ]);

        //$user = new User();
        //$user->name = $request->employee_name;
        //$user->password = $request->
        $user = User::create([
            'email' => $request->email,
            'name' => $request->employee_name,
            'password' => $request->password
        ]);

        //$user = User::create($request->except('roles'));
        
        if($request->roles <> ''){
            $user->roles()->attach($request->roles);
        }

        $emp = new Employee();
        $emp->employee_code =  $request->employee_code;
        $emp->employee_birthdate =  $request->employee_birthdate;
        $emp->employee_join_date =  $request->employee_join_date;
        $emp->department_id =  $request->department_id;
        $emp->position_id =  $request->position_id;
        $emp->employee_basic =  $request->employee_basic;
        $emp->employee_allowance =  $request->employee_allowance;
        $emp->user_id = $user->id;
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
        $dept = Department::pluck('department_name','id')->toArray();
        $post = Position::pluck('position_name','id')->toArray();
        $roles = Role::get();
        $user = User::findOrFail($emp->user_id);
        $params = [
            'title' => 'Edit Pegawai',
            'emp' => $emp,
            'post' => $post,
            'user'=>$user,
            'dept' => $dept,
            'roles' => $roles,
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
        $emp->employee_code =  $request->employee_code;
        //$emp->employee_name =  $request->employee_name;
        $emp->employee_birthdate =  $request->employee_birthdate;
        $emp->employee_join_date =  $request->employee_join_date;
        $emp->department_id =  $request->department_id;
        $emp->position_id =  $request->position_id;
        $emp->employee_basic =  $request->employee_basic;
        $emp->employee_allowance =  $request->employee_allowance;
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
