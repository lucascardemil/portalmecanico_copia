<?php

namespace App\Http\Controllers;

use App\VehicleBrand;
use Illuminate\Http\Request;

class VehicleBrandController extends Controller
{

    /* Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $brands = VehicleBrand::orderBy('id', 'DESC')
                ->brand()
                ->paginate(10);

       return [
           'pagination' => [
               'total'         => $brands->total(),
               'current_page'  => $brands->currentPage(),
               'per_page'      => $brands->perPage(),
               'last_page'     => $brands->lastPage(),
               'from'          => $brands->firstItem(),
               'to'            => $brands->lastItem(),
           ],
           'vehiclebrands' => $brands
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
           'brand' => 'required|min:2|max:190',
       ], [
           'brand.required' => 'El campo nombre es obligatorio',
           'brand.min' => 'El campo nombre debe tener al menos 4 caracteres',
           'brand.max' => 'El campo nombre debe tener a lo más 190 caracteres',
       ]);

       $data = $request->all();

       VehicleBrand::create($data);
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\VehicleBrand  $brand
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $brand = VehicleBrand::findOrFail($id);

       return $brand;
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\VehicleBrand  $brand
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
    $this->validate($request, [
        'brand' => 'required|min:2|max:190',
    ], [
        'brand.required' => 'El campo marca es obligatorio',
        'brand.min' => 'El campo nombre debe tener al menos 4 caracteres',
        'brand.max' => 'El campo nombre debe tener a lo más 190 caracteres',
    ]);

       VehicleBrand::find($id)->update($request->all());

       return;
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\VehicleBrand  $brand
    * @return \Illuminate\Http\Response
    */
   public function destroy(Vehicle $vehicle)
   {
       //
   }
   public function all()
   {
       
        $vehiclebrands = VehicleBrand::orderBy('id', 'ASC')->get();

        return $vehiclebrands;
   }

}
