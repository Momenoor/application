<?php

namespace App\Http\Controllers;

use App\Services\Permission as ServicesPermission;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = app(ServicesPermission::class)->getRoles();
        return view('pages.users.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = ServicesPermission::resolve(Permission::all());
        return view('pages.users.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $permissions = array_values($request->permissions);
        $role = Role::make($validated);
        $role->saveOrFail();
        $role->syncPermissions($permissions);

        return redirect()->to(route('role.index'))->withToastSuccess(__('app.role_added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->withCount('users');
        return view('pages.users.roles.view', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $selectedPermissions = $role->permissions->pluck('id')->toArray();
        $permissions = ServicesPermission::resolve(Permission::all());
        return view('pages.users.roles.edit', compact('role', 'selectedPermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id.',id',
        ]);

        $permissions = array_values($request->permissions);
        $role->name = data_get($validated, 'name');
        $role->saveOrFail();
        $role->syncPermissions($permissions);

        return redirect()->to(route('role.show', $role))->withToastSuccess(__('app.role_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
