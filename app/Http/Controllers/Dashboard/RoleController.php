<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:roles_read')->only(['index']);
        $this->middleware('permission:roles_create')->only(['create','store']);
        $this->middleware('permission:roles_update')->only(['edit','update']);
        $this->middleware('permission:roles_delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $roles = Role::whereRoleNot(['super_admin','user' , 'admin'])
            ->whenSearch($request->search)
            ->with('permissions')
            ->with('users')
            ->withCount('users')
            ->paginate(5);
        return view('dashboard.roles.home',compact('roles'));

    }

    public function create()
    {
        return view('dashboard.roles.create');
    }



    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array|min:1',
        ]);


        $role = Role::create($request->all());

        $role->attachPermissions($request->permissions);


        session()->flash('success','Data added successfully');
        return redirect()->route('dashboard.roles.index');
    }



    public function edit(Role $role)
    {
        return view('dashboard.roles.edit',compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([

            'name' => 'required|unique:roles,name,' . $role->id ,
            'permissions' => 'required|array|min:1',

        ]);

        $role->update($request->all());
        $role->syncPermissions($request->permissions);

        session()->flash('success','Data update successfully');
        return redirect()->route('dashboard.roles.index');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success','Data delete successfully');
        return redirect()->route('dashboard.roles.index');
    }


}
