<?php

namespace App\Http\Controllers;

use App\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleModelController extends Controller
{

    /* Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $models = VehicleModel::select(DB::raw('vehicle_models.id as id,vehicle_brands.brand as brand,vehicle_models.model'))
                ->join('vehicle_brands', 'vehicle_brands.id', '=', 'vehicle_models.brand_id')
                ->paginate(10);

       return [
           'pagination' => [
               'total'         => $models->total(),
               'current_page'  => $models->currentPage(),
               'per_page'      => $models->perPage(),
               'last_page'     => $models->lastPage(),
               'from'          => $models->firstItem(),
               'to'            => $models->lastItem(),
           ],
           'vehiclemodels' => $models
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
       $this->validate($request, [
           //'brand_id' => 'required',
           'model' => 'required|min:2|max:190',
       ], [
           //'brand_id.required' => 'El campo brand_id es obligatorio',
           'model.required' => 'El campo modelo es obligatorio',
           'model.min' => 'El campo nombre debe tener al menos 4 caracteres',
           'model.max' => 'El campo nombre debe tener a lo más 190 caracteres',
       ]);

       $data = $request->all();
       
       VehicleModel::create($data);
       
  }

   /**
    * Display the specified resource.
    *
    * @param  \App\VehicleModel  $model
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $model = VehicleModel::findOrFail($id);

       return $model;
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\VehicleModel  $model
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
    $this->validate($request, [
        'model' => 'required|min:2|max:190',
    ], [
        'model.required' => 'El campo nombre es obligatorio',
        'model.min' => 'El campo nombre debe tener al menos 4 caracteres',
        'model.max' => 'El campo nombre debe tener a lo más 190 caracteres',
    ]);

       VehicleModel::find($id)->update($request->all());

       return;
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\VehicleModel  $model
    * @return \Illuminate\Http\Response
    */
   public function destroy(Vehicle $vehicle)
   {
       //
   }


   public function all()
   {

        $vehiclemodels = VehicleModel::select(DB::raw('vehicle_models.id as id,vehicle_brands.brand as brand,vehicle_models.model'))
        ->join('vehicle_brands', 'vehicle_brands.id', '=', 'vehicle_models.brand_id')
        ->brand()
        ->get();
        
        return $vehiclemodels;
   }

}