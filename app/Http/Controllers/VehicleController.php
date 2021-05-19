<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;

        $users = User::where('id', '=', $user_id)->with('roles')->get();

        foreach ($users as $user) {
            foreach ($user->roles as $roles) {
                if($roles->name == 'admin'){

                    $vehicles = Vehicle::with('user')->paginate(10);
                    
                    return [
                        'pagination' => [
                            'total'         => $vehicles->total(),
                            'current_page'  => $vehicles->currentPage(),
                            'per_page'      => $vehicles->perPage(),
                            'last_page'     => $vehicles->lastPage(),
                            'from'          => $vehicles->firstItem(),
                            'to'            => $vehicles->lastItem(),
                        ],
                        'vehicles' => $vehicles
                    ];

                }else{
                    $vehicles = Vehicle::orderBy('id', 'DESC')
                            ->where('user_id', '=', $user_id)
                            ->with('user')
                            ->patent()
                            ->name()
                            ->year()
                            ->paginate(10);

                    return [
                        'pagination' => [
                            'total'         => $vehicles->total(),
                            'current_page'  => $vehicles->currentPage(),
                            'per_page'      => $vehicles->perPage(),
                            'last_page'     => $vehicles->lastPage(),
                            'from'          => $vehicles->firstItem(),
                            'to'            => $vehicles->lastItem(),
                        ],
                        'vehicles' => $vehicles
                    ];
                    
                }
            }
        }
    }

    // public function index()
    // {
    //     $vehicles = Vehicle::with('user')->get();

    //     return $vehicles;
    // }

    public function clientvehicles()
    {
        $user_id =  \Auth::user()->id;

        $clients = DB::table('users')
            ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
            ->where('mechanic_client.mechanic_id', '=', $user_id)
            ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.created_at', 'users.updated_at')
            ->get();

        $client_ids = array();

        foreach ($clients as $client) {
            array_push($client_ids, $client->id);
        }


        $vehicles = Vehicle::with('user')->whereIn('user_id', $client_ids)->get();

        return $vehicles;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = \Auth::user()->id;

        $vehicles = DB::table('vehicles')->where('user_id', '=', $id)->count();

        $mechanics = DB::table('users')
            ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
            ->where('mechanic_client.user_id', '=', $id)
            ->get();

        if($vehicles >= $mechanics[0]->cant_vehicle){
            return response()->json('Failure', 422);
        }else{
            $this->validate($request, [
                'patent' => 'required|min:4|max:190',
                'chasis' => 'required|min:4|max:190',
                'color' => 'required|min:4|max:190',
                'km' => 'required|min:1|max:190',

            ], [
                'patent.required' => 'El campo patente es obligatorio',
                'patent.min' => 'El campo patente debe tener al menos 4 caracteres',
                'patent.max' => 'El campo patente debe tener a lo más 190 caracteres',
                'chasis.required' => 'El campo chasis es obligatorio',
                'chasis.min' => 'El campo chasis debe tener al menos 4 caracteres',
                'chasis.max' => 'El campo chasis debe tener a lo más 190 caracteres',
                'color.required' => 'El campo color es obligatorio',
                'color.min' => 'El campo color debe tener al menos 4 caracteres',
                'color.max' => 'El campo color debe tener a lo más 190 caracteres',
                'km.required' => 'El campo km es obligatorio',
                'km.min' => 'El campo km debe tener al menos 1 caracteres',
                'km.max' => 'El campo km debe tener a lo más 190 caracteres',
            ]);

            $data = $request->all();

            if($data['user_id'] == '')
            {
                $data['user_id'] = \Auth::user()->id;
            }

            Vehicle::create($data);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id)->detail_vehicles;

        return $vehicle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'patent' => 'required|min:4|max:190',
            'chasis' => 'required|min:4|max:190',
            'color' => 'required|min:4|max:190',
            'km' => 'required|min:1|max:190',

        ], [
            'patent.required' => 'El campo patente es obligatorio',
            'patent.min' => 'El campo patente debe tener al menos 4 caracteres',
            'patent.max' => 'El campo patente debe tener a lo más 190 caracteres',
            'chasis.required' => 'El campo chasis es obligatorio',
            'chasis.min' => 'El campo chasis debe tener al menos 4 caracteres',
            'chasis.max' => 'El campo chasis debe tener a lo más 190 caracteres',
            'color.required' => 'El campo color es obligatorio',
            'color.min' => 'El campo color debe tener al menos 4 caracteres',
            'color.max' => 'El campo color debe tener a lo más 190 caracteres',
            'km.required' => 'El campo km es obligatorio',
            'km.min' => 'El campo km debe tener al menos 1 caracteres',
            'km.max' => 'El campo km debe tener a lo más 190 caracteres',
        ]);

        Vehicle::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    public function indexByUser()
    {
        $user_id = \Auth::user()->id;
        $vehicles = Vehicle::orderBy('id', 'DESC')
                            ->where('user_id', '=', $user_id)
                            ->with('user')
                            ->paginate(10);

        return [
            'pagination' => [
                'total'         => $vehicles->total(),
                'current_page'  => $vehicles->currentPage(),
                'per_page'      => $vehicles->perPage(),
                'last_page'     => $vehicles->lastPage(),
                'from'          => $vehicles->firstItem(),
                'to'            => $vehicles->lastItem(),
            ],
            'vehicles' => $vehicles
        ];
    }
}
