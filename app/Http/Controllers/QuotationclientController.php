<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Client;
use App\Quotationclient;
use App\QuotationUser;
use App\QuotationUserVehicle;
use App\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class QuotationclientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $id = request('id');
        $razonSocial = request('razonSocial');
        $client = request('client');
        $vehicle = request('vehicle');
        $day = request('day');
        $month = request('month');
        $year = request('year');


        if($user_id == 1)
            $quotationclients = DB::table('quotationclients')
                                    ->join('clients', 'quotationclients.client_id', '=', 'clients.id')
                                    ->select(
                                        'quotationclients.id',
                                        'clients.rut',
                                        'clients.razonSocial',
                                        'quotationclients.client_text',
                                        'quotationclients.vehicle',
                                        'quotationclients.payment',
                                        'quotationclients.state',
                                        'quotationclients.generado_client',
                                        'quotationclients.tipo_detalle',
                                        'quotationclients.generado',
                                        'quotationclients.created_at',
                                        'quotationclients.url'
                                    )
                                    ->orderBy('quotationclients.id', 'DESC')
                                    ->where('quotationclients.generado', '<>', 3)
                                    ->where('quotationclients.generado', '<>', 5)
                                    ->when($id, function ($query, $id) {
                                        return $query->where('quotationclients.id', 'like', '%' . $id . '%');
                                    })
                                    ->when($razonSocial, function ($query, $razonSocial) {
                                        return $query->where('clients.razonSocial', 'like', '%' . $razonSocial . '%');
                                    })
                                    ->when($client, function ($query, $client) {
                                        return $query->where('quotationclients.client_text', 'like', '%' . $client . '%');
                                    })
                                    ->when($vehicle, function ($query, $vehicle) {
                                        return $query->where('quotationclients.vehicle', 'like', '%' . $vehicle . '%');
                                    })
                                    ->when($day, function ($query, $day) {
                                        return $query->whereDay('quotationclients.created_at', $day);
                                    })
                                    ->when($month, function ($query, $month) {
                                        return $query->whereMonth('quotationclients.created_at', $month);
                                    })
                                    ->when($year, function ($query, $year) {
                                        return $query->whereYear('quotationclients.created_at', $year);
                                    })
                                    ->paginate(10);
       
        else                
                            
            $quotationclients = DB::table('quotationclients')
                                    ->join('clients', 'quotationclients.client_id', '=', 'clients.id')
                                    ->select(
                                        'quotationclients.id',
                                        'clients.rut',
                                        'clients.razonSocial',
                                        'quotationclients.client_text',
                                        'quotationclients.vehicle',
                                        'quotationclients.payment',
                                        'quotationclients.state',
                                        'quotationclients.generado_client',
                                        'quotationclients.tipo_detalle',
                                        'quotationclients.generado',
                                        'quotationclients.created_at',
                                        'quotationclients.url'
                                    )
                                    ->orderBy('quotationclients.id', 'DESC')
                                    ->where('quotationclients.generado', '<>', 3)
                                    ->where('quotationclients.user_id', '=', $user_id)
                                    ->when($id, function ($query, $id) {
                                        return $query->where('quotationclients.id', 'like', '%' . $id . '%');
                                    })
                                    ->when($razonSocial, function ($query, $razonSocial) {
                                        return $query->where('clients.razonSocial', 'like', '%' . $razonSocial . '%');
                                    })
                                    ->when($client, function ($query, $client) {
                                        return $query->where('quotationclients.client_text', 'like', '%' . $client . '%');
                                    })
                                    ->when($vehicle, function ($query, $vehicle) {
                                        return $query->where('quotationclients.vehicle', 'like', '%' . $vehicle . '%');
                                    })
                                    ->when($day, function ($query, $day) {
                                        return $query->whereDay('quotationclients.created_at', $day);
                                    })
                                    ->when($month, function ($query, $month) {
                                        return $query->whereMonth('quotationclients.created_at', $month);
                                    })
                                    ->when($year, function ($query, $year) {
                                        return $query->whereYear('quotationclients.created_at', $year);
                                    })
                                    ->paginate(10);

            return [
                'pagination' => [
                    'total'         => $quotationclients->total(),
                    'current_page'  => $quotationclients->currentPage(),
                    'per_page'      => $quotationclients->perPage(),
                    'last_page'     => $quotationclients->lastPage(),
                    'from'          => $quotationclients->firstItem(),
                    'to'            => $quotationclients->lastItem(),
                ],
                'quotationclients' => $quotationclients
            ];

    }

    public function clientsform()
    {
        $user_id = Auth::id();
        $id = request('id');
        $razonSocial = request('razonSocial');
        $client = request('client');
        $vehicle = request('vehicle');
        $day = request('day');
        $month = request('month');
        $year = request('year');

        $quotationclientsform = DB::table('quotationclients')
                                ->join('clients', 'quotationclients.client_id', '=', 'clients.id')
                                ->select(
                                    'quotationclients.id',
                                    'clients.rut',
                                    'clients.razonSocial',
                                    'quotationclients.client_text',
                                    'quotationclients.vehicle',
                                    'quotationclients.payment',
                                    'quotationclients.state',
                                    'quotationclients.generado_client',
                                    'quotationclients.tipo_detalle',
                                    'quotationclients.generado',
                                    'quotationclients.created_at'
                                )
                                ->orderBy('quotationclients.id', 'DESC')
                                ->where('quotationclients.generado', '=', 3)
                                ->orWhere('quotationclients.generado', '=', 5)
                                ->when($id, function ($query, $id) {
                                    return $query->where('quotationclients.id', 'like', '%' . $id . '%');
                                })
                                ->when($razonSocial, function ($query, $razonSocial) {
                                    return $query->where('clients.razonSocial', 'like', '%' . $razonSocial . '%');
                                })
                                ->when($client, function ($query, $client) {
                                    return $query->where('quotationclients.client_text', 'like', '%' . $client . '%');
                                })
                                ->when($vehicle, function ($query, $vehicle) {
                                    return $query->where('quotationclients.vehicle', 'like', '%' . $vehicle . '%');
                                })
                                ->when($day, function ($query, $day) {
                                    return $query->whereDay('quotationclients.created_at', $day);
                                })
                                ->when($month, function ($query, $month) {
                                    return $query->whereMonth('quotationclients.created_at', $month);
                                })
                                ->when($year, function ($query, $year) {
                                    return $query->whereYear('quotationclients.created_at', $year);
                                })
                                ->paginate(10);


        return [
            'pagination_form' => [
                'total'         => $quotationclientsform->total(),
                'current_page'  => $quotationclientsform->currentPage(),
                'per_page'      => $quotationclientsform->perPage(),
                'last_page'     => $quotationclientsform->lastPage(),
                'from'          => $quotationclientsform->firstItem(),
                'to'            => $quotationclientsform->lastItem(),
            ],
            'quotationclientsform' => $quotationclientsform
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

        $data = $request->all();

        $data['user_id'] = \Auth::user()->id;

        $roles = DB::table('roles')
            ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->where('users.id', '=', \Auth::user()->id)
            ->select('roles.id')
            ->get();

        foreach ($roles as $rol) {
            if($rol->id == 2 && isset($data['cliente_part'])){
                $data['generado'] = 1;
                $data['tipo_detalle'] = 1;
            }else{
                if($data['client_id'] == 1){
                    $data['generado'] = 1;
                }else{
                    $data['generado'] = 2;
                }
            }  
        }


        if(isset($data['cliente_part'])){
            $clients = Client::where('user_id', '=', \Auth::user()->id)->where('type', '=', 'Cliente Particular')->get();
            foreach ($clients as $client) {
                $quotation_id = Quotationclient::create(
                    [
                        'user_id' => \Auth::user()->id,
                        'client_id' => $client->id,
                        'state' => 'Pendiente',
                        'payment' => 'Contado',
                        'client_text' => $data['client_text'],
                        'vehicle' => $data['vehicle'],
                        'generado' => $data['generado'],
                        'url' => $data['url']
                    ])->id;
            }
        }else{
            $quotation_id = Quotationclient::create(
                [
                    'user_id' => \Auth::user()->id,
                    'client_id' => $data['client_id'],
                    'state' => 'Pendiente',
                    'payment' => 'Contado',
                    'client_text' => $data['client_text'],
                    'vehicle' => $data['vehicle'],
                    'generado' => $data['generado'],
                    'url' => $data['url']
                ])->id; 
        }   
        
        
        return $quotation_id;

        //$quotationclient = Quotationclient::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotationclient  $quotationclient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotationclient = Quotationclient::find($id);

        return $quotationclient;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotationclient  $quotationclient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Quotationclient::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotationclient  $quotationclient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quotationclient = Quotationclient::findOrFail($id);
        $quotationuser = QuotationUser::where('quotation_id', '=' , $quotationclient->id)->first();

        if($quotationuser === null){
            $quotationclient->delete();
        }else{
            $quotationuser = QuotationUser::where('quotation_id', '=' , $quotationclient->id)->firstOrFail();
            $quotationuservehicle = QuotationUserVehicle::where('user_id', '=' , $quotationuser->id)->firstOrFail();
            $quotationuservehicle->delete();
            $quotationuser->delete();
            $quotationclient->delete();
        }
    
        return;
    }

    public function details($id)
    {
        return Quotationclient::findOrFail($id)->detailclients;
    }

    public function pdf($id)
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $products = Quotationclient::findOrFail($id)->detailclients;
        $quotation = Quotationclient::find($id);

        $user = User::find($quotation->user_id);
        $client = Quotationclient::find($id)->client;

        $pdf = PDF::loadView('pdf.quotationclient', compact(['user', 'quotation', 'client', 'products']) );

        return $pdf->stream('cotizacion N° '.$id.'.pdf');

        ///return $pdf->download('cotizacion N° '.$id.'.pdf');
    }

    public function pdfIva($id)
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $products = Quotationclient::findOrFail($id)->detailclients;
        $quotation = Quotationclient::find($id);

        $user = User::find($quotation->user_id);
        $client = Quotationclient::find($id)->client;

        $pdf = PDF::loadView('pdf.quotationclientiva', compact(['user', 'quotation', 'client', 'products']) );

        //return $pdf->download('cotizacion N° '.$id.'.pdf');
        return $pdf->stream('cotizacion N° '.$id.'.pdf');
    }
    
    public function all()
    {

        $vehiclemodels = VehicleModel::select(DB::raw('vehicle_models.id as id,
                                                        vehicle_models.model as model,
                                                        vehicle_years.v_year as year,
                                                        vehicle_engines.v_engine as motor'))
                                                ->join('vehicle_years', 'vehicle_models.id', '=', 'vehicle_years.v_id')
                                                ->join('vehicle_engines', 'vehicle_years.id', '=', 'vehicle_engines.year_id')
                                                ->get();
        
        return $vehiclemodels;
    }



    public function forms()
    {
        $id = request('id');
        $quotationform = DB::table('quotation_users')
                        ->join('quotationclients', 'quotation_users.quotation_id', '=', 'quotationclients.id')
                        ->join('quotation_user_vehicles', 'quotation_users.id', '=', 'quotation_user_vehicles.user_id')
                        ->select(
                            'quotation_users.id',
                            'quotation_users.name',
                            'quotation_users.email',
                            'quotation_users.phone',
                            'quotation_user_vehicles.patentchasis',
                            'quotation_user_vehicles.brand',
                            'quotation_user_vehicles.model',
                            'quotation_user_vehicles.year',
                            'quotation_user_vehicles.engine',
                            'quotation_user_vehicles.description',
                            'quotation_users.created_at',
                            'quotationclients.generado',
                            'quotationclients.generado_client',
                            'quotationclients.payment'
                        )
                        ->where('quotation_users.quotation_id', '=', $id )->get();
        return $quotationform;
        
    }

    
}
