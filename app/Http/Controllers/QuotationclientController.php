<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Quotationclient;
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
        // if($user_id == 1 || $user_id == 2)
        //     $quotationclients = Quotationclient::with('client')->orderBy('id', 'DESC')->paginate(10);
        // else
        $quotationclients = Quotationclient::with('client')
                                ->whereHas('client', function ($q) {
                                    $q->razonsocial();
                                })
                                ->id()
                                ->date()
                                ->orderBy('id', 'DESC')->where('user_id', '=', $user_id)
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
            if($rol->id == 2){
                $data['generado'] = 1;
            }else{
                $data['generado'] = 2;
            }  
        }

        $quotationclient = Quotationclient::create($data);

        return $quotationclient->id;
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
        $quotationclient->delete();

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
