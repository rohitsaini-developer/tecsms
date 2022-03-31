<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display the admin login view.
     *
     * @return \Illuminate\View\View
     */
    public function adminCreate()
    {
        if(!Auth::check()){ 
             return view('auth.admin.login');
        }
    }
    public function login(Request $request) {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
        $previousUrl = url()->previous();
        $arrayUrl    = explode('/', $previousUrl);
        $flag = 0;
        
        if(in_array('admin', $arrayUrl)){
            $flag =1;
        }
        $remember_me = $request->has('remember') ? true : false; 
        if (Auth::attempt($request->only('email', 'password'), $remember_me)) {
            $user = Auth::user();  
            if($flag == 1){
                if($user->hasRole('admin')){
                    return to_route('admin.home');
                } else {
                    auth()->logout();
                }
            } else {
                if(!$user->hasRole('admin')){
                    return to_route('user.home');
                } else {
                    auth()->logout();
                }
            }
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();  

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        if($user->hasRole('admin')){
            return to_route('admin.login');
        } else {
            return to_route('login');
        }
    }
}
