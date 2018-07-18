<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function getAllPermissions()
    {
        $permission = Permission::select('name')->get();

        return response()->json($permission);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        $params = [
            'title' => 'Daftar Permission',
            'permissions' => $permissions,
        ];
        return view('permissions.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = new Permission;
        $roles = Role::get(); //Get all roles
        $params = [
            'title' => 'Permission Baru',
            'roles' => $roles,
            'permission' => $permission,
        ];

        return view('permissions.form')->with($params);
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
            'name'=>'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        if ($request->roles <> '') { 
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value); 
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->route('permissions.index')->with('success','Permission added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $permission = Permission::findOrFail($id);
        $roles = Role::get(); //Get all roles
        $params = [
            'title' => 'Edit Permission',
            'permission' => $permission,
            'roles' => $roles,
        ];

        return view('permissions.form')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
        $permission->name=$request->name;
        $permission->save();
        return redirect()->route('permissions.index')
            ->with('success',
             'Permission'. $permission->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')
            ->with('success',
             'Permission deleted successfully!');
    }
}
