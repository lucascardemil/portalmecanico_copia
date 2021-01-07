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


    public function showLoginForm($url = null)
    {
        if(isset($url)){
            $users = User::where('url', $url)->get();
            foreach ($users as $user) {
                if(!empty($user->mac)){
                    if($user->mac == $this->mac()){
                        return view('auth.login', ['url' => $url]);
                    }else{
                        return redirect()->route('acceso', ['url' => $user->url, 'name' => $user->name]);
                    }
                }else{
                    return redirect()->route('acceso', ['url' => $user->url, 'name' => $user->name]);
                }
            }
        }else{
            return redirect('error_ip');
        }
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $users = User::where('mac', $this->mac())->get();
        foreach ($users as $user) {
            return $this->loggedOut($request) ?: redirect()->route('acceso', ['url' => $user->url]);
        }
    }


    public function mac(){
        $mac='UNKNOWN';
        foreach(explode("\n",str_replace(' ','',trim(`getmac`,"\n"))) as $i)
        if(strpos($i,'Tcpip')>-1){$mac=substr($i,0,17);break;}
        return $mac;
    }
}
