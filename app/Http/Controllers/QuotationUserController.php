<?php

namespace App\Http\Controllers;

use App\Client;
use App\QuotationUser;
use App\QuotationUserVehicle;
use App\QuotationUserDescription;
use App\Http\Requests\StoreQuotationUser;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\EmailNotificator;
use App\Quotationclient;
use Auth;

class QuotationUserController extends Controller
{
    use Notifiable;

    public function index(){

        // $id = request('id');
        // $client = request('client');
        // $day = request('day');
        // $month = request('month');
        // $year = request('year');
 
        // $quotations = DB::table('quotation_users')
        //                 ->join('quotation_user_vehicles', 'quotation_users.id', '=', 'quotation_user_vehicles.user_id')
        //                 ->join('clients', 'quotation_users.client_id', '=', 'clients.id')
        //                 ->select(
        //                     'quotation_users.id',
        //                     'quotation_users.state',
        //                     'clients.rut',
        //                     'clients.razonSocial',
        //                     'quotation_users.name',
        //                     'quotation_users.email',
        //                     'quotation_users.phone',
        //                     'quotation_users.payment',
        //                     'quotation_user_vehicles.patentchasis',
        //                     'quotation_user_vehicles.brand',
        //                     'quotation_user_vehicles.model',
        //                     'quotation_user_vehicles.year',
        //                     'quotation_user_vehicles.engine',
        //                     'quotation_user_vehicles.description',
        //                     'quotation_users.created_at'
        //                 )
        //                 ->where('quotation_users.id', 'LIKE', '%'. $id . '%')
        //                 ->where('quotation_users.name', 'LIKE', '%'. $client . '%')
        //                 ->where(function($query) use ($day,$month,$year){
        //                     if($day!=''){
        //                         $query->whereDay('quotation_users.created_at', $day);
        //                     }
        //                     if($month!=''){
        //                         $query->whereMonth('quotation_users.created_at', $month);
        //                     }
        //                     if($year!=''){
        //                         $query->whereYear('quotation_users.created_at', $year);
        //                     }
        //                 })
                        

        //                 ->orderBy('quotation_user_vehicles.created_at', 'DESC')
        //                 ->paginate(20);
        // return [
        //     'pagination' => [
        //         'total'         => $quotations->total(),
        //         'current_page'  => $quotations->currentPage(),
        //         'per_page'      => $quotations->perPage(),
        //         'last_page'     => $quotations->lastPage(),
        //         'from'          => $quotations->firstItem(),
        //         'to'            => $quotations->lastItem(),
        //     ],
        //     'quotations' => $quotations
        // ];

    }

    

    public function cotizar(){
        return view('quotation');
    }
    
    public function store(StoreQuotationUser $request){
        $validate = $request->validated();
        $data = $request->all();

        $name         = $data['name'];
        $email        = $data['email'];
        $phone        = $data['phone'];
        $patentchasis = $data['patentchasis'];
        $brand        = $data['brand'];
        $model        = $data['model'];
        $year         = $data['year'];
        $engine       = $data['engine'];
        $description  = $data['description'];
        $user_id_logeado = Auth::id();


        $quotation_id = Quotationclient::firstOrCreate(
        [
            'user_id' => $user_id_logeado, //usuario alvaro por defecto
            'client_id' => 1, //usuario particular
            'state' => 'Pendiente',
            'payment' => 'Contado',
            'client_text' => $name,
            'vehicle' => $brand.' '.$model.' '.$year.' '.$engine,
            'generado' => 3
        ])->id;

        $user_id = QuotationUser::firstOrCreate(
            [ 
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'quotation_id' => $quotation_id
            ]
        )->id;

        QuotationUserVehicle::create(
            [ 
                'patentchasis' => $patentchasis,
                'user_id' => $user_id,
                'brand' => $brand,
                'model' => $model,
                'year' => $year,
                'engine' => $engine,
                'email' => $email,
                'description' => $description
            ]
        );

        // QuotationUserDescription::create(
        //     [
        //         'user_id' => $user_id,
        //         'vehicle_id' => $vehicle_id,
        //         'patentchasis' => $patentchasis,
        //         'description' => $description,
        //         'is_completed' => 0,
        //         'email' => $email
        //     ]);

        // $client_id = Client::firstOrCreate( 
        //     [ 
        //         'user_id' => $user_id,
        //         'name' => $name,
        //         'rut' => 'CLIENTE PARTICULAR',
        //         'razonSocial' => 'CLIENTE PARTICULAR',
        //         'giro' => 'CLIENTE PARTICULAR',
        //         'email' => $email,
        //         'phone' => $phone,
        //         'type' => 'Cliente'
        //     ]
        // )->id;

        

        $user = new User();
        $user->email = 'comercialsupra4@gmail.com';
        $user->notify(new EmailNotificator($name, $email, $phone, $patentchasis, $description));

        return response()->json(
        [
            'valid'=> true,
            'data' => [ 'message' => 'Cotizacion ingresada correctamente!' ]
        ], 200);
    }

    public function show($id){
        return QuotationUser::findOrFail($id)->email;
    }

    public function storeMechanic(Request $request){

        $data = $request->all();
        
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $user_id_logeado = Auth::id();
        
        $patentchasis = $data['patentchasis'];
        $brand = $data['brand'];
        $model = $data['model'];
        $year = $data['year'];
        $engine = $data['engine'];
        $description = $data['description'];
        


        $quotation_id = Quotationclient::firstOrCreate(
        [
            'user_id' => $user_id_logeado, //usuario alvaro por defecto
            'client_id' => 1, //usuario particular
            'state' => 'Pendiente',
            'payment' => 'Contado',
            'client_text' => $name,
            'vehicle' => $brand.' '.$model.' '.$year.' '.$engine,
            'generado' => 4,
            'tipo_detalle' => 1
        ])->id;

        $user_id = QuotationUser::firstOrCreate(
            [ 
                'name' => $name,
                'email' => $email,
                
                'quotation_id' => $quotation_id
            ]
        )->id;

        QuotationUserVehicle::create(
            [ 
                'patentchasis' => $patentchasis,
                'user_id' => $user_id,
                'brand' => $brand,
                'model' => $model,
                'year' => $year,
                'engine' => $engine,
                'email' => $email,
                'description' => $description
            ]
        );

        $user = new User();
        $user->email = 'comercialsupra4@gmail.com';
        $user->notify(new EmailNotificator($name, $email, $patentchasis, $description));

        return response()->json([
            'valid'=> true,
            'data' => [
                'message' => 'Cotizacion ingresada correctamente!'
            ]
        ], 200);
    }



}
