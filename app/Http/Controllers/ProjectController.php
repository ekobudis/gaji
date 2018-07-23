<?php

namespace App\Http\Controllers;

use Auth;
use App\Employee;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        $projects = Project::all();
        $params = [
            'title' => 'Daftar Proyek',
            'projects' => $projects,
        ];

        return view('projects.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $emp = Employee::pluck('emp_name','id')->toArray();
        
        $params = [
            'title' => 'Proyek Baru',
            'project' => $project,
            'emp' => $emp,
        ];

        return view('projects.form')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = $this->validate($request,[
            'project_code' => 'required',
            'project_name' => 'required',
            'project_desc' => 'required',
            'project_amounts' => 'required'
        ]);

        $project = new Project();
        $project->project_code = request('project_code');
        $project->project_name = request('project_name');
        $project->project_desc = request('project_desc');
        $project->project_start = request('project_start');
        $project->project_end = request('project_end');
        $project->project_amounts = request('project_amounts');
        $project->employee_id = request('employee_id');
        $project->user_id = Auth::user()->id;
        $project->save();

        return redirect()->route('projects.index')->with('success','Proyek berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $emp = Employee::pluck('employee_name','id')->toArray();
        
        $params = [
            'title' => 'Edit Proyek',
            'project' => $project,
            'emp' => $emp,
        ];

        return view('projects.form')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->project_code = request('project_code');
        $project->project_name = request('project_name');
        $project->project_desc = request('project_desc');
        $project->project_start = request('project_start');
        $project->project_end = request('project_end');
        $project->project_amounts = request('project_amounts');
        $project->employee_id = request('employee_id');
        $project->user_id = Auth::user()->id;
        $project->save();

        return redirect()->route('projects.index')->with('success','Proyek berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success','Proyek berhasil di hapus');        
    }
}
