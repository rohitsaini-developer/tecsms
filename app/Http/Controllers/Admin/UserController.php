<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        abort_if(Gate::denies('user-browse'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('user-add'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all()->pluck('sortname', 'id');
        $roles = Role::whereNotIn('name', ['admin', 'postpaid'])->pluck('name','id');
        return view('admin.user.create', compact('roles', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $input = $request->all();
        $input['password']                  = Hash::make($request->password);
        $input['email_verified_at']         = date('Y-m-d H:i:s');
        $input['phone_number_verified_at']  = date('Y-m-d H:i:s');
        $input['register_type']             = 4;

        $create_user =  User::create($input);

        $create_user->assignRole($request->roles);

        if($create_user){
            return to_route('admin.users.index')->with('success', 'User added successfully!');
        }else{
            return to_route('admin.users.index')->with('error', 'Something went wrong! Try after some time.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->with('roles');
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->with('roles');
        $countries = Country::all()->pluck('sortname', 'id');
        $roles = Role::whereNotIn('name', ['admin'])->pluck('name','id');
        return view('admin.user.edit',compact('user','roles', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync([$request->roles]);

        if($user){
            return to_route('admin.users.index')->with('success', 'User Updated successfully!');
        }else{
            return to_route('admin.users.index')->with('error', 'Something went wrong! Try after some time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user){
        if($request->ajax()){
            $user->roles()->detach();
            $user->delete();
            return response()->json([ 'success' => true, 'message'=>'User deleted successfully!']);
        }
    }

    /**
     * Show the change password of specific user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('admin.user.change-password');
    }

    /**
     * Update current user password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
                'oldpassword' => 'required|min:6|max:20',
                'newpassword' => 'required|confirmed|min:6|max:20',
            ]
        );

        $checkOldPassword = Hash::check($request->oldpassword, Auth::user()->password);
        if($checkOldPassword){
            $updatePassword = Auth::user()->update(['password'=> Hash::make($request->newpassword)]);
            if($updatePassword){
                Auth::logout();
                return redirect()->back()->with('success', 'Password changed successfully!');
            }else{
                return redirect()->back()->with('error', 'Something went wrong. Please try after some time.');
            }
        }else{
            return redirect()->back()->with('error', 'Current password does not match.');
        }
    }

    /**
     * Show the change password of specific user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePasswordByAdmin($id)
    {
        $user = User::find($id);
        $userRoles = $user->getRoleNames()->toArray();

        if(array_intersect(['postpaid', 'prepaid'], $userRoles)){
            $userId = $user->id;
            return view('admin.user.change_password_admin',compact('userId'));
        }else{
            return abort(404);
        }
    }

    public function updatePasswordByAdmin(Request $request,$id){
           
        $validated = $request->validate([
            'newpassword'         => 'required',
            'newpassword_confirmation' => 'required|same:newpassword' 
        ]);
        
        $password = $request->newpassword;
        $user = User::find($id);
        $userRoles = $user->getRoleNames()->toArray();

        if(array_intersect(['postpaid', 'prepaid'], $userRoles)){
            $user->update(['password' => Hash::make($password)]);
            return to_route('admin.users.index')->with('success','User changed password successfully!');
        } else {
            return to_route('admin.users.index')->with('error', 'Something went wrong! Try after some time.');
        }
    }
}
