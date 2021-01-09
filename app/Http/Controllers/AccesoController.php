<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class AccesoController extends Controller
{

    public function index(Request $request, $url)
    {
        $users = User::where('url', $url)->get();
        foreach ($users as $user) {
            if(!empty($user->url)){
                if($user->url == $url){
                    return view('acceso', ['url' => $user->url, 'name' => $user->name]);
                }else{
                    return redirect('error_ip');
                }
            }else{
                return view('acceso', ['url' => $user->url, 'name' => $user->name]);
            }
        }
        
    }
    
    public function acceso(Request $request, $url)
    {
        $users = User::where('url', $url)->get();
        foreach ($users as $user) {
            if(!empty($user->url)){
                if($user->url == $url){
                    return redirect()->route('login', ['url' => $user->url]);
                }else{
                    return redirect('error_ip');
                }
            }else{
                return redirect('error_ip');
            }
        }
    }

    
}
