<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Gate;
use Symfony\Component\HttpFoundation\Response;

use App\DataTables\RolesDataTable;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        abort_if(Gate::denies('role-browse'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('role-add'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions_array = array();
        $permissions = Permission::where('route_name', '!=' , "permissions")->select('id', 'name', 'route_name','function_name')->get();
        $permision_not_show = array('store','update','updateProfile','updatePassword','updateChange');
        foreach($permissions as $permission){
            if( !in_array($permission['function_name'], $permision_not_show) ){
                $permissions_array[$permission->route_name][$permission['id']] = $permission['name'];
            }
        }
        return view('admin.role.create', compact('permissions_array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('role-store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions.*' => 'integer',
            'permissions' => 'required|array'
        ]);

        $role = Role::create($request->all());
        $permissions_array =  $request->input('permissions');
    
        foreach($permissions_array as $permissionId){
            $permission = Permission::find($permissionId);
            $getPermissionId = Permission::where('route_name',$permission->route_name);
            if( $permission->function_name == 'create' ){
                $permissions_array[]= $getPermissionId->where('function_name','store')->value('id');
            }else if($permission->function_name == 'edit'){
                $permissions_array[]= $getPermissionId->where('function_name','update')->value('id');
            }else if($permission->function_name == 'profile'){
                $permissions_array[]= $getPermissionId->where('function_name','updateProfile')->value('id');
            }else if($permission->function_name == 'changePassword'){
                $permissions_array[]= $getPermissionId->where('function_name','updatePassword')->value('id');
            }else if($permission->function_name == 'change'){
                $permissions_array[]= $getPermissionId->where('function_name','updateChange')->value('id');
            }
        }
        $role->permissions()->sync($permissions_array);
        if($role){
            return to_route('admin.roles.index')->with('success','Role created successfully!');
        }else{
            return to_route('admin.roles.index')->with('error','Something went wrong! Try in some time.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        abort_if(Gate::denies('role-view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies('role-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $selected_permission=array();
        $permissions_array = array();

        foreach($role->permissions as $key => $item){
            $selected_permission[] = $item->id;
        }
       
        $permissions = Permission::where('route_name', '!=' , "permissions")->select('id', 'name', 'route_name','function_name')->get();
        $permision_not_show = array('store','update','updateProfile','updatePassword','updateChange');
        foreach($permissions as $permission){
            if( !in_array($permission['function_name'], $permision_not_show) ){
                $permissions_array[$permission->route_name][$permission['id']] = $permission['name'];
            }
        }
        return view('admin.role.edit',compact('role','permissions_array','selected_permission'));
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
        abort_if(Gate::denies('role-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id.'|max:255',
        ]);

        $role->update($request->all());
        
        $permissions_array =  $request->input('permissions');
    
        foreach($permissions_array as $permissionId){
            $permission = Permission::find($permissionId);
            $getPermissionId = Permission::where('route_name',$permission->route_name);
            if( $permission->function_name == 'create' ){
                $permissions_array[]= $getPermissionId->where('function_name','store')->value('id');
            }else if($permission->function_name == 'edit'){
                $permissions_array[]= $getPermissionId->where('function_name','update')->value('id');
            }else if($permission->function_name == 'profile'){
                $permissions_array[]= $getPermissionId->where('function_name','updateProfile')->value('id');
            }else if($permission->function_name == 'changePassword'){
                $permissions_array[]= $getPermissionId->where('function_name','updatePassword')->value('id');
            }else if($permission->function_name == 'change'){
                $permissions_array[]= $getPermissionId->where('function_name','updateChange')->value('id');
            }
        }

        $role->permissions()->sync($permissions_array);

        if($role){
            return to_route('admin.roles.index')->with('success','Role updated successfully!');
        }else{
            return to_route('admin.roles.index')->with('error','Something went wrong! Try in some time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        abort_if(Gate::denies('role-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $role->users()->detach();
            $role->permissions()->detach();
            $role->delete();
            return response()->json([ 'success' => true, 'message'=>'Role deleted successfully!']);
        }
    }
}
