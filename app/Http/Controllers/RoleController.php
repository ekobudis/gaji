<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRoles(){

        $role = Role::all();
        
        return DataTables::of($role)
            ->addColumn('action',function($role){
                return '<div class="text-center"><a href="roles/'. $role->id . '/edit"><i class="icon-pencil4"> </i> </a> ' .
                        '<a href="#" onclick="showDelete('. $role->id . ')"  > <i class="icon-trash"></i></a> </div>';
            })->rawColumns(['status','action'])
            ->make(true);
    }
    /*public function __construct()
    {
        $this->middleware(['auth','permission_clearance']);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $params = [
            'title' => 'Daftar Role Access',
            'roles' => $roles,
        ];
        return view('roles.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        $permissions = Permission::all();//Get all permissions

        $params = [
            'title' => 'Role Access Baru',
            'permissions' => $permissions,
            'role' => $role,
        ];

        return view('roles.form')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:15',
            'permissions' =>'required',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }
        return redirect()->route('roles.index')->with('success','Roles added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $params = [
            'title' => 'Edit Role Access',
            'role' => $role,
            'permissions' => $permissions,
        ];
        return view('roles.form')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);//Get role with the given id
    //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);
        $input = $request->except(['permissions']);
        $role->fill($input)->save();
        if($request->permissions <> ''){
            $role->permissions()->sync($request->permissions);
        }
        return redirect()->route('roles.index')->with('success','Roles updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success',
             'Role deleted successfully!');
    }
}
