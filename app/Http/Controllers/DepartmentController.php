<?php

namespace App\Http\Controllers;

use Auth;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDeptCode(Request $request,$id)
    {
        $dept = Department::findOrFail($id);

        return response()->json($dept);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        $params = [
            'title' => 'Daftar Departemen',
            'departments' => $departments,
        ];

        return view('departments.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts = new Department;
        $params = [
            'title' => 'Departement Baru',
            'depts' => $depts,
        ];

        return view('departments.form')->with($params);
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
            'dept_name' => 'required'
        ]);

        $dept = new Department();
        $dept->dept_code =  $request->dept_code;
        $dept->dept_name =  $request->dept_name;
        $dept->dept_desc =  $request->dept_desc;
        $dept->user_id = Auth::user()->id;
        $dept->save();

        return redirect()->route('departments.index')->with('success','Departemen berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depts = Department::findOrFail($id);
        $params = [
            'title' => 'Edit Departement',
            'depts' => $depts,
        ];

        return view('departments.form')->with($params);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dept = Department::findOrFail($id);
        $dept->dept_code =  $request->dept_code;
        $dept->dept_name =  $request->dept_name;
        $dept->dept_desc =  $request->dept_desc;
        $dept->save();

        return redirect()->route('departments.index')->with('success','Departemen berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Department::findOrFail($id);
        $dept->delete();

        return redirect()->route('departments.index')->with('success','Departemen berhasil di hapus');
    }
}
