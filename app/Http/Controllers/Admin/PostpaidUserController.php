<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Country;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PostpaidUsersDataTable;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PostpaidUser\StoreRequest;
use App\Http\Requests\PostpaidUser\UpdateRequest;

class PostpaidUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostpaidUsersDataTable $dataTable)
    {
        abort_if(Gate::denies('postpaid-user-browse'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.postpaid-user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('postpaid-user-add'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.postpaid-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        abort_if(Gate::denies('postpaid-user-stroe'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $input = $request->all();
        $country_id = Country::where('phonecode', $input['country_code'])->first()->id;
        
        $input['country_id']                = $country_id;
        $input['password']                  = Hash::make($request->password);
        $input['email_verified_at']         = date('Y-m-d H:i:s');
        $input['phone_number_verified_at']  = date('Y-m-d H:i:s');
        $input['register_type']             = 4;

        $create_user =  User::create($input);

        $create_user->assignRole(2);
        $data = [
            'user_name'     => $create_user->name,
            'email'         => $create_user->email,
            // 'billing_id'    => $create_user->billing_id,
            'password'      => $request->password,
        ];
        sendMail('partials.email-template.send-user-details', $data, $create_user, 'Your Tecsms account Details');

        // store token
        /* $phoneToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
        $emailToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
        UserToken::create([
            'user_id'               => $create_user->id,
            'user_email_token'      => $emailToken,
            'email_token_status'    => 2,
            'user_phone_token'      => $phoneToken,
            'phone_token_status'    => 2,
        ]); */

        if($create_user){
            return to_route('admin.postpaid-users.index')->with('success', 'Postpaid user added successfully!');
        }else{
            return back()->with('error', 'Something went wrong! Try after some time.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $postpaid-user
     * @return \Illuminate\Http\Response
     */
    public function show(User $postpaidUser)
    {
        abort_if(Gate::denies('postpaid-user-view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countryCode = Country::where('id', $postpaidUser->country_id)->first()->phonecode;
        return view('admin.postpaid-user.show',compact('postpaidUser', 'countryCode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $postpaid-user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $postpaidUser)
    {
        abort_if(Gate::denies('postpaid-user-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countryCode = Country::where('id', $postpaidUser->country_id)->first()->phonecode;
        return view('admin.postpaid-user.edit',compact('postpaidUser','countryCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $postpaid-user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $postpaidUser)
    {
        abort_if(Gate::denies('postpaid-user-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $input = $request->all();
        $country_id = Country::where('phonecode', $input['country_code'])->first()->id;
        $input['country_id'] = $country_id;

        $postpaidUser->update($input);

        if($postpaidUser){
            return to_route('admin.postpaid-users.index')->with('success', 'Postpaid user Updated successfully!');
        }else{
            return back()->with('error', 'Something went wrong! Try after some time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $postpaid-user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $postpaidUser)
    {
        abort_if(Gate::denies('postpaid-user-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $postpaidUser->roles()->detach();
            $postpaidUser->delete();
            return response()->json([ 'success' => true, 'message'=>'Postpaid user deleted successfully!']);
        }
    }
}
