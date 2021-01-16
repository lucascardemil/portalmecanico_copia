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
        //$user_id = Auth::id();

        $user_id = QuotationUser::firstOrCreate( 
            [ 'email' => $email ],
            [ 
                'name' => $name,
                'phone' => $phone 
            ])->id;

        $vehicle_id = QuotationUserVehicle::firstOrCreate(
            [ 'patentchasis' => $patentchasis ],
            [
                'user_id' => $user_id,
                'brand' => $brand,
                'model' => $model,
                'year' => $year,
                'engine' => $engine,
            ]
        )->id;

        QuotationUserDescription::create(
        [
            'user_id' => $user_id,
            'vehicle_id' => $vehicle_id,
            'patentchasis' => $patentchasis,
            'description' => $description,
            'is_completed' => 0
        ]);

        $client_id = Client::firstOrCreate( 
            [ 
                'user_id' => $user_id,
                'name' => $name,
                'rut' => 'CLIENTE PARTICULAR',
                'razonSocial' => 'CLIENTE PARTICULAR',
                'giro' => 'CLIENTE PARTICULAR',
                'email' => $email,
                'phone' => $phone,
                'type' => 'Cliente'
            ])->id;

        Quotationclient::create(
        [
            'user_id' => 2, //usuario alvaro por defecto
            'client_id' => $client_id, //usuario particular
            'state' => 'Pendiente',
            'payment' => 'CONTADO',
            'client_text' => $name,
            'vehicle' => $brand.' '.$model.' '.$year.' '.$engine,
        ]);

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
        $user_id = QuotationUser::firstOrCreate([ 'email' => $email ], [ 'name' => $name])->id;
        //$user_id = Auth::user()->id;
        
        $patentchasis = $data['patentchasis'];
        $brand = $data['brand'];
        $model = ' ';
        $year = $data['year'];
        $engine = $data['engine'];
        if (is_null($engine))
            $engine = ' ';
        $description = $data['description'];

        

        $vehicle_id = QuotationUserVehicle::firstOrCreate(
            [
                'patentchasis' => $patentchasis,
            ],
            [
                'email' => $email,
                'user_id' => $user_id,
                'brand' => $brand,
                'model' => $model,
                'year' => $year,
                'engine' => $engine,
            ]
        )->id;

        QuotationUserDescription::create([
            'email' => $email,
            'user_id' => $user_id,
            'vehicle_id' => $vehicle_id,
            'patentchasis' => $patentchasis,
            'description' => $description,
            'is_completed' => 0
        ]);

        Quotationclient::create([
            'user_id' => 2, //usuario alvaro por defecto
            'client_id' => 1, //usuario particular
            'state' => 'Pendiente',
            'payment' => 'CONTADO',
            'client_text' => $name,
            'vehicle' => $brand.' '.$model.' '.$year.' '.$engine,
        ]);

        // $user = new User();
        // $user->email = 'lcuelloalfa@gmail.com';
        // $user->notify(new EmailNotificator($name, $email, 0, $patentchasis, $description));

        return response()->json([
            'valid'=> true,
            'data' => [
                'message' => 'Cotizacion ingresada correctamente!'
            ]
        ], 200);
    }



}
