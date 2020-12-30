<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm($url)
    {
       
            $users = User::where('url', $url)->get();
            foreach ($users as $user) {
                if(!empty($user->ip_acceso)){
                    if($user->ip_acceso == request()->ip()){
                        return view('auth.login', ['url' => $url]);
                    }else{
                        return view('acceso', ['url' => $user->url, 'name' => $user->name]);
                    }
                }else{
                    return view('acceso', ['url' => $user->url, 'name' => $user->name]);
                }
            }
        
    }
}
