<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDatatable;
use App\Services\Permission as ServicesPermission;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public $isUpdate = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionDatatable $dataTable)
    {
        return $dataTable->render('pages.users.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isUpdate = $this->isUpdate;
        return view('pages.users.permissions.create', compact('isUpdate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (\Str::contains($request->get('name'), 'resource')) {
            $model =  app(ServicesPermission::class)->getKeyName($request->get('name'), true, 'lower');
            $abililties = [
                'create',
                'edit',
                'view',
                'delete',
            ];
            foreach ($abililties as $abililtie) {
                $name = $model . '-' . $abililtie;
                $guardName = $guardName ?? Guard::getDefaultName(Permission::class);
                $perm = Permission::getPermission(['name' => $name, 'guard_name' => $guardName]);
                if (!$perm) {
                    $permissions[] = ['name' => $name, 'guard_name' => $guardName];
                }
            }
            Permission::insert($permissions);
        } else {
            $request->merge([
                'name' => app(ServicesPermission::class)->setName($request->name),
            ]);

            $validated = $request->validate([
                'name' => 'required|unique:permissions,name'
            ]);

            $permission = Permission::make($validated);
            $permission->saveOrFail();
        }

        return redirect()->to(route('permission.index'))->withToastSuccess(__('app.permission_added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $isUpdate = $this->isUpdate = true;
        return view('pages.users.permissions.create', compact('isUpdate', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {

        $request->merge([
            'name' => app(ServicesPermission::class)->setName($request->name),
        ]);

        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . ',id'
        ]);

        $permission->fill($validated);
        $permission->save();

        return redirect()->to(route('permission.index'))->withToastSuccess(__('app.permission_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->to(route('permission.index'))->withToastInfo(__('app.permission_deleted_successfully'));
    }
}
