<?php

namespace App\Http\Controllers;

use Auth;
use App\Towns;
use App\QuotationShipping;
use App\Http\Requests\StoreQuotationShipping;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class QuotationShippingController extends Controller
{
    public function cotizar_envio(){
        return view('quotationshipping');
    }

    public function ciudades(){

        $ciudades = Towns::orderBy('id', 'ASC')->get();

        return $ciudades;
    }

    public function user(){

        $id = \Auth::user()->id;

        return $id;
    }

    public function all()
    {
        $quotationshipping = DB::table('quotation_shippings')
                                    ->join('towns', 'quotation_shippings.ciudad', '=', 'towns.id')
                                    ->select(
                                        'quotation_shippings.id',
                                        'quotation_shippings.nombre',
                                        'quotation_shippings.rut',
                                        'quotation_shippings.telefono',
                                        'towns.nombre as ciudad',
                                        'quotation_shippings.direccion',
                                        'quotation_shippings.sucursal'
                                    )
                                    ->orderBy('quotation_shippings.id', 'DESC')->get();

        return $quotationshipping;
    }
    
    public function store(StoreQuotationShipping $request){

        $data = $request->all();
        
        $user_id_logeado = $data['id'];
        $nombre = $data['nombre'];
        $rut = $data['rut'];
        $telefono = $data['telefono'];
        $ciudad = $data['ciudad'];
        $direccion = $data['direccion'];
        $sucursal = $data['sucursal'];
        
        QuotationShipping::create([
            'user_id' => $user_id_logeado, //usuario alvaro por defecto
            'nombre' => $nombre,
            'rut' => $rut,
            'telefono' => $telefono,
            'ciudad' => $ciudad,
            'direccion' => $direccion,
            'sucursal' => $sucursal
        ]);
    

        return response()->json([
            'valid'=> true,
            'data' => [
                'message' => 'Cotizacion ingresada correctamente!'
            ]
        ], 200);
    }


    public function pdf($id)
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $shippings = DB::table('quotation_shippings')
                            ->join('towns', 'quotation_shippings.ciudad', '=', 'towns.id')
                            ->select(
                                'quotation_shippings.id',
                                'quotation_shippings.nombre',
                                'quotation_shippings.rut',
                                'quotation_shippings.telefono',
                                'towns.nombre as ciudad',
                                'quotation_shippings.direccion',
                                'quotation_shippings.sucursal'
                            )->where('quotation_shippings.id', '=', $id )
                            ->orderBy('quotation_shippings.id', 'DESC')->get();

        $pdf = PDF::loadView('pdf.quotationshipping', compact(['shippings']) )->setPaper([ 0 , 0 , 226.772 , 141.732 ], 'landscape');


        return $pdf->stream('Envio_'.$id.'.pdf');

        ///return $pdf->download('cotizacion N° '.$id.'.pdf');
    }
}