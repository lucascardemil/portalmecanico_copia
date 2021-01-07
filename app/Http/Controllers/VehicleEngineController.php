<?php

namespace App\Http\Controllers;

use App\VehicleEngine;
use App\VehicleYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleEngineController extends Controller
{

    public function all($year){
        $engines = VehicleEngine::select(DB::raw('vehicle_engines.id as id, vehicle_engines.v_engine as engine'))
                                    ->join('vehicle_years', 'vehicle_years.id', '=', 'vehicle_engines.year_id')
                                    ->where('vehicle_years.id', '=', $year)->get();

        /*     
        SELECT v_engine
        FROM vehicle_engine AS v1
        INNER JOIN vehicle_year AS v2
            ON v1.year_id = v2.id
        INNER JOIN vehicle_brand_model AS v3
            ON v3.id = v2.v_id
        WHERE v_year=1984 AND 
            v3.brand='HONDA' AND 
            v3.model='ACCORD' 
        */

        return $engines;
    }

     /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       $this->validate($request, [
           'v_engine' => 'required|min:4|max:190'
       ], [
           'v_engine.required' => 'El campo motor es obligatorio',
           'v_engine.min' => 'El campo motor debe tener al menos 4 caracteres',
           'v_engine.max' => 'El campo motor debe tener a lo más 4 caracteres'
       ]);

       $engines = DB::table('vehicle_engines')->where([
                                                    ['year_id', '=', $request->year_id],
                                                    ['v_engine', '=', $request->v_engine]])
                                                    ->get();
        if (!$engines->isEmpty()) {
            return response()->json([
                'errors' => [
                    'v_engine' => 'El año y motor, ya existen'
                    ]
                ], 422);
        }else{
            $data = $request->all();
            VehicleEngine::create($data);
        }
   }

   public function update(Request $request, $id)
   {
        $this->validate($request, [
            'v_engine' => 'required|min:4|max:190'
        ], [
            'v_engine.required' => 'El campo motor de inicio es obligatorio',
            'v_engine.min' => 'El campo motor de inicio debe tener al menos 4 caracteres',
            'v_engine.max' => 'El campo motor de inicio debe tener a lo más 4 caracteres'
        ]);

        VehicleEngine::find($id)->update($request->all());

       return;
   }

   public function all_motors()
   {
       
        $motors = VehicleEngine::select(DB::raw('vehicle_engines.id as id,
                                              vehicle_years.v_year as year,
                                              vehicle_engines.v_engine as motor,
                                              vehicle_models.model as model'))
                ->join('vehicle_years', 'vehicle_years.id', '=', 'vehicle_engines.year_id')
                ->join('vehicle_models', 'vehicle_models.id', '=', 'vehicle_years.v_id')
                ->paginate(10);

       return [
           'pagination_motor' => [
               'total'         => $motors->total(),
               'current_page'  => $motors->currentPage(),
               'per_page'      => $motors->perPage(),
               'last_page'     => $motors->lastPage(),
               'from'          => $motors->firstItem(),
               'to'            => $motors->lastItem(),
           ],
           'vehiclemotors' => $motors
       ];

   }

   public function selectMotores()
   {
        $motores = VehicleEngine::orderBy('id', 'ASC')->get();

        return $motores;
   }

}
