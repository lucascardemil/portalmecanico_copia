<?php

namespace App\Http\Controllers\User;


use Auth;
use App\User;
use App\Service;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshwork\ChileanBundle\Rut;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.store')->only('store');
        $this->middleware('permission:users.update')->only('update');
        $this->middleware('permission:users.destroy')->only('destroy');*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
            $users = User::orderBy('id', 'DESC')->with('roles')->paginate(10);

            return [
                'pagination' => [
                    'total'         => $users->total(),
                    'current_page'  => $users->currentPage(),
                    'per_page'      => $users->perPage(),
                    'last_page'     => $users->lastPage(),
                    'from'          => $users->firstItem(),
                    'to'            => $users->lastItem(),
                ],
                'users' => $users
            ];
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = request('id');

        $this->validate($request, [
            'name' => 'required|min:4|max:190',
            'email' => ['required', 'email', 'min:6', 'max:150',
                        \Illuminate\Validation\Rule::unique('users')->ignore(User::find($id))],
            'password' => 'required|min:6|max:190',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener al menos 6 caracteres',
            'name.max' => 'El campo nombre debe tener a lo más 190 caracteres',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.min' => 'El campo de correo electrónico debe tener al menos 6 caracteres',
            'email.max' => 'El campo de correo electrónico debe tener a lo más 150 caracteres',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo de contraseña debe tener al menos 6 caracteres',
            'password.max' => 'El campo de contraseña debe tener a lo más 150 caracteres',
        ]);

        $data = $request->all();

        //$data['rut'] = Rut::parse($data['rut'])->format();
        //$data['password'] = bcrypt(Rut::parse($data['rut'])->format(Rut::FORMAT_ESCAPED));
        $data['password'] = bcrypt( $data['password'] );
        $data['url'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20); 

        $user = User::create($data);

        if($data['cant_client'] > 0 || $data['cant_vehicle'] > 0){
            $user->roles()->sync(array(0 => '2'));
        }

        DB::table('quotationclients')->where('id', $id)->update(
            [
                'generado_client' => 1, 
            ]
        );

        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:190',
            'email' => ['required', 'email', 'min:6', 'max:150',
                        \Illuminate\Validation\Rule::unique('users')->ignore(User::find($id))],
            'password' => 'required|min:6|max:190',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener al menos 6 caracteres',
            'name.max' => 'El campo nombre debe tener a lo más 190 caracteres',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.min' => 'El campo de correo electrónico debe tener al menos 6 caracteres',
            'email.max' => 'El campo de correo electrónico debe tener a lo más 150 caracteres',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo de contraseña debe tener al menos 6 caracteres',
            'password.max' => 'El campo de contraseña debe tener a lo más 150 caracteres',
        ]);

        $data = $request->all();

        //$data['rut'] = Rut::parse($data['rut'])->format();
        //$data['password'] = bcrypt(Rut::parse($data['rut'])->format(Rut::FORMAT_ESCAPED));
        $data['password'] = bcrypt( $data['password'] );
        $data['url'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);

        User::find($id)->update($data);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mechanics = DB::table('mechanic_client')
            ->join('users', 'users.id', '=', 'mechanic_client.user_id')
            ->where('mechanic_client.user_id', '=', $id)->delete();

        if($mechanics){
            $user = User::findOrFail($id);
            $user->delete();
        }
        

        return;
    }

    public function all()
    {
        $user = User::orderBy('id', 'DESC')->get();

        return $user;
    }

    public function getId()
    {
        $id = \Auth::user()->id;

        return $id;
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function clients()
    {
        $user_id = \Auth::user()->id;

        $clients = DB::table('users')
            ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
            ->where('mechanic_client.mechanic_id', '=', $user_id)
            ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.url', 'users.url', 'users.cant_vehicle')
            ->get();

        return $clients;
    }

    public function storeclient(Request $request)
    {
        $id = request('id');
        $user = $this->store($request);

        $user->roles()->sync(array(0 => '3'));

        DB::table('mechanic_client')->insertOrIgnore(
            [
                'user_id' => $user->id, 
                'mechanic_id' => \Auth::user()->id
                //'quotation_id' => request('id')
            ]
        );

        DB::table('quotationclients')->where('id', $id)->update(
            [
                'generado_client' => 1, 
            ]
        );
    }

    public function storeclient2(Request $request)
    {
        $id = \Auth::user()->id;

        $clients = DB::table('users')->where('id', '=', $id)->get();

        $total = DB::table('users')
            ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
            ->where('mechanic_client.mechanic_id', '=', $id)
            ->count();

        $data = $request->all();
        
        if($total >= $clients[0]->cant_vehicle){
            return response()->json('¡No se pueden asignar vehiculos a mas clientes!', 422);
        }else{
            if($total >= $clients[0]->cant_client){
                return response()->json('¡Supero la cantidad de clientes!', 422);
            }else{

                $suma_vehicles = DB::table('users')
                    ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
                    ->where('mechanic_client.mechanic_id', '=', $id)
                    ->sum('users.cant_vehicle');

                $total_vehicle = $data['cant_vehicle'] + $suma_vehicles;

                if($total_vehicle > $clients[0]->cant_vehicle){
                    return response()->json('supero la cantidad de vehiculos', 422);
                }else{

                    $data['password'] = bcrypt( $data['password'] );
                    $data['url'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);

                    $user = User::create($data);
                    $user->roles()->sync(array(0 => '3'));

                    DB::table('mechanic_client')->insertOrIgnore(
                        [
                            'user_id' => $user->id, 
                            'mechanic_id' => \Auth::user()->id
                        ]
                    );
                }
            }
        }
    }
    
    public function updateRole(Request $request, User $user)
    {
        //$user->update($request);
        //actualizar roles
        
        $user->roles()->sync($request->all());
    }

    public function updateCantVehicleUser(Request $request, $id)
    {
        $mechanic = \Auth::user()->id;
        $data = $request->all();


        $suma_vehicles = DB::table('users')
                    ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
                    ->where('mechanic_client.mechanic_id', '=', $mechanic)
                    ->sum('users.cant_vehicle');

        $mechanics = DB::table('users')->where('id', '=', $mechanic)->get();

    
        $total_vehicle = $data['cant_vehicle'] + $suma_vehicles;

        if($data['cant_vehicle'] == 0){
            return response()->json('¡La cantidad no puede ser 0!', 422);
        }else{
            if($total_vehicle > $mechanics[0]->cant_vehicle){
                return response()->json('¡Error, Ya no puede crear mas vehiculos!', 422);
            }else{
                DB::table('users')->where('id', $id)->update(
                    [
                        'cant_vehicle' => $total_vehicle
                    ]
                );
                return;
            }
        }
    }

    public function updateCantCliVehiUser(Request $request, $id)
    {   
        $data = $request->all();

        $users = DB::table('users')->where('id', '=', $id)->get();

        $total_vehicle = $data['cant_vehicle'] + $users[0]->cant_vehicle;
        $total_client = $data['cant_client'] + $users[0]->cant_client;

        DB::table('users')->where('id', $id)->update(
            [
                'cant_vehicle' => $total_vehicle,
                'cant_client' => $total_client 
            ]
        );

        return;
    }

    public function quotation_roles()
    {
        $user_id = \Auth::user()->id;
        $users = User::where('id', '=', $user_id)->with('roles')->get();

        return $users;
    }


    public function totalVehi()
    {
        $mechanic = \Auth::user()->id;
        $suma_vehicles = DB::table('users')
                    ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
                    ->where('mechanic_client.mechanic_id', '=', $mechanic)
                    ->sum('users.cant_vehicle');
        $users = DB::table('users')->where('id', '=', $mechanic)->get();

        $total_vehicles   = ['total_vehicles' => ($users[0]->cant_vehicle - $suma_vehicles)];
        return $total_vehicles;
    }


    public function totalCli()
    {
        $mechanic = \Auth::user()->id;
        $suma_clients = DB::table('users')
                    ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
                    ->where('mechanic_client.mechanic_id', '=', $mechanic)
                    ->count();
             
        $users = DB::table('users')->where('id', '=', $mechanic)->get();

        $total_clients = ['total_clients' => ($users[0]->cant_client - $suma_clients)];
        return $total_clients;
    }



    public function totalCliAdmin($id)
    {
        $suma_clients = DB::table('users')
                    ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
                    ->where('mechanic_client.mechanic_id', '=', $id)
                    ->count();
             
        $users = DB::table('users')->where('id', '=', $id)->get();

        $total_clients = ['total_clients' => ($users[0]->cant_client - $suma_clients)];
        return $total_clients;
    }


    public function totalVehiAdmin($id)
    {
        $suma_vehicles = DB::table('users')
                    ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
                    ->where('mechanic_client.mechanic_id', '=', $id)
                    ->sum('users.cant_vehicle');
        $users = DB::table('users')->where('id', '=', $id)->get();

        $total_vehicles   = ['total_vehicles' => ($users[0]->cant_vehicle - $suma_vehicles)];
        return $total_vehicles;
    }
}
