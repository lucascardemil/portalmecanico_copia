<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class AccesoController extends Controller
{

    public function index($url)
    {
        $users = User::where('url', $url)->get();
        foreach ($users as $user) {
            return view('acceso', ['url' => $user->url, 'name' => $user->name]);
        }
    }
    
    public function update(Request $request, $url)
    {
        $users = User::where('url', $url)->get();
        foreach ($users as $user) {
            $user->ip_acceso = $request->ip();
            //$user->url = $request->url();

            $user->save();
            return redirect()->route('login', ['url' => $user->url]);
        }
    }
}
