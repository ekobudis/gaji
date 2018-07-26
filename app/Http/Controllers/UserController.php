<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\Role;
use App\User;
use App\Employee;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate();
        $params = [
            'title' => 'Daftar User',
            'users' => $users,
        ];
        return view('users.index')->with($params);
    }

    public function create()
    {
        $user = new User;
        $roles = Role::get();
        $params = [
            'title' => 'User Baru',
            'roles' => $roles,
            'user' => $user,
        ];

        return view('users.form')->with($params);
    }

    public function store(Request $request)
    {
        /*$errors = $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);*/

        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required'
        ]);*/
        
        $user = User::create($request->except('roles'));
        
        if($request->roles <> ''){
            $user->roles()->attach($request->roles);
        }

        return redirect()->route('users.index')->with('success','User baru berhasil disimpan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get(); 
        $params = [
            'title' => 'Edit User',
            'roles' => $roles,
            'user' => $user,
        ];

        return view('users.form')->with($params);   
    }

    public function getProfile($id)
    {
        $user = User::findOrFail($id);
        $emp = Employee::where('user_id','=',$id)->first();
        if(!$emp){
            $emp = Employee::where('user_id','=',$id)->first();
        }else{
            $emp = new Employee;
        }
        $roles = Role::get();
        $params = [
            'title' => 'Edit Profile',
            'roles' => $roles,
            'user' => $user,
            'emp' => $emp,
        ];

        return view('users.profile')->with($params);      
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);   
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);
        $input = $request->except('roles');
        $user->fill($input)->save();
        if ($request->roles <> '') {
            $user->roles()->sync($request->roles);        
        }        
        else {
            $user->roles()->detach(); 
        }
        
        return redirect()->route('users.index')->with('success',
             'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attend $attend)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return view('users.index')->with('success','Data User barhasil di hapus');
    }
}
