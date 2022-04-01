<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Gate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

use App\DataTables\PermissionsDataTable;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionsDataTable $dataTable)
    {
        abort_if(Gate::denies('permission-browse'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('permission-store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('permission-store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validated = $request->validate([
            'name'            => 'required|unique:permissions|max:255',
        ]);
        $permission = Permission::create($request->all());

        $permission->roles()->attach(1);
        if($permission){
            return to_route('admin.permissions.index')->with('success','Permission created successfully!');
        }else{
            return to_route('admin.permissions.index')->with('error','Something went wrong! Try in some time.');
        }
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
        abort_if(Gate::denies('permission-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.permission.edit', compact('permission'));
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
        abort_if(Gate::denies('permission-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validated = $request->validate([
            'name'            => 'required|unique:permissions,name,'.$permission->id.'|max:255',
        ]);
        $permission->update($request->all());
        if($permission){
            return to_route('admin.permissions.index')->with('success','Permission updated successfully!');
        }else{
            return to_route('admin.permissions.index')->with('error','Something went wrong! Try in some time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        abort_if(Gate::denies('permission-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $permission->roles()->detach();
            $permission->delete();
            return response()->json([ 'success' => true, 'message'=>'Permission deleted successfully!']);
        }
    }
}
