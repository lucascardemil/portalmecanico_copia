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
            if(!empty($user->ip_acceso)){
                if($user->ip_acceso == request()->ip()){
                    return view('acceso', ['url' => $user->url, 'name' => $user->name]);
                }else{
                    return redirect('error_ip');
                }
            }else{
                return view('acceso', ['url' => $user->url, 'name' => $user->name]);
            }
        }
    }
    
    public function update(Request $request, $url)
    {
        $users = User::where('url', $url)->get();
        foreach ($users as $user) {
            if(!empty($user->ip_acceso)){
                if($user->ip_acceso == request()->ip()){
                    return redirect()->route('login', ['url' => $user->url]);
                }else{
                    return redirect('error_ip');
                }
            }else{
                $user->ip_acceso = $request->ip();
                $user->save();
                return redirect()->route('login', ['url' => $user->url]);
            }
        }
    }
}
