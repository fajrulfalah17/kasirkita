<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::when(request()->q, function($roles) {
            $roles = $roles->where('name', 'like', '%'. request()->q . '%');
        })->with('permissions')->latest()->paginate(5);

        // render with inertia
        return inertia('Apps/Roles/Index', [
            'roles'     => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return inertia('Apps/Roles/Create', [
            'permissions'   => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        // create roel
        $role = Role::create(['name'    => $request->name]);

        // assign permission to role
        $role->givePermissionTo($request->permissions);

        // redirect
        return redirect()->route('apps.roles.index');
    }

    public function edit($id)
    {
        // get role
        $role = Role::with('permissions')->findOrFail($id);

        // get permission all
        $permissions = Permission::all();

        // render inertia
        return inertia('Apps/Roles/Edit', [
            'role'          => $role,
            'permissions'   => $permissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        // create roel
        $role->update(['name'    => $request->name]);

        // assign permission to role
        $role->givePermissionTo($request->permissions);

        // redirect
        return redirect()->route('apps.roles.index');
    }

    public function destroy($id)
    {
        $roles = Role::findOrFail($id);

        $roles->delete();

        return redirect()->route('apps.roles.index');
    }
}
