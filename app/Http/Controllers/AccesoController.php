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
            if(!empty($user->mac)){
                if($user->mac == $this->mac()){
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
            if(!empty($user->mac)){
                if($user->mac == $this->mac()){
                    return redirect()->route('login', ['url' => $user->url]);
                }else{
                    return redirect('error_ip');
                }
            }else{
                
                $user->mac = $this->mac();
                $user->save();
                return redirect()->route('login', ['url' => $user->url]);
            }
        }
    }

    public function mac(){
        $mac='UNKNOWN';
        foreach(explode("\n",str_replace(' ','',trim(`getmac`,"\n"))) as $i)
        if(strpos($i,'Tcpip')>-1){$mac=substr($i,0,17);break;}
        return $mac;
    }
    
}
