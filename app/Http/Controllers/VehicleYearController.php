<?php

namespace App\Http\Controllers;

use App\VehicleYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleYearController extends Controller
{
    public function all($brand, $model){
            $years = VehicleYear::select(DB::raw('vehicle_years.id as id, vehicle_years.v_year as year'))
                                    ->join('vehicle_brand_models', 'vehicle_brand_models.id', '=', 'vehicle_years.v_id')
                                    ->where([['vehicle_brand_models.brand', '=', $brand],
                                            ['vehicle_brand_models.model', '=', $model]])
                                    ->orderBy('v_year', 'DESC')
                                    ->get();

        /*    
        SELECT v_year 
        FROM vehicle_years AS v1
        INNER JOIN vehicle_brand_model AS v2
            ON v1.v_id = v2.id
        WHERE v2.brand = 'HONDA' AND
            v2.model = 'ACCORD' 
        */

        return $years;
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
           'v_year' => 'required|unique:vehicle_years|min:4|max:4'
       ], [
           'v_year.unique' => 'El modelo y año ya existen',
           'v_year.required' => 'El campo año de inicio es obligatorio',
           'v_year.min' => 'El campo año de inicio debe tener al menos 4 caracteres',
           'v_year.max' => 'El campo año de inicio debe tener a lo más 4 caracteres'
       ]);

       $data = $request->all();

       VehicleYear::create($data);
   }

   public function update(Request $request, $id)
   {
        $this->validate($request, [
            'v_year' => 'required|min:4|max:4'
            //'year_fin' => 'required|min:4|max:4'
            //'motor' => 'required|min:2|max:190',
        ], [
            'v_year.required' => 'El campo año de inicio es obligatorio',
            'v_year.min' => 'El campo año de inicio debe tener al menos 4 caracteres',
            'v_year.max' => 'El campo año de inicio debe tener a lo más 4 caracteres'
            //'year_fin.required' => 'El campo año final es obligatorio',
            //'year_fin.min' => 'El campo año final debe tener al menos 4 caracteres',
            //'year_fin.max' => 'El campo año final debe tener a lo más 4 caracteres'
            /*'motor.required' => 'El campo motor es obligatorio',
            'motor.min' => 'El campo motor debe tener al menos 4 caracteres',
            'motor.max' => 'El campo motor debe tener a lo más 190 caracteres'*/
        ]);

        VehicleYear::find($id)->update($request->all());

       return;
   }

   public function all_year()
   {
       
        $years = VehicleYear::select(DB::raw('vehicle_years.id as id,
                                              vehicle_years.v_year as year,
                                              vehicle_models.model as model,
                                              vehicle_brands.brand as brand'))
                ->join('vehicle_models', 'vehicle_models.id', '=', 'vehicle_years.v_id')
                ->join('vehicle_brands', 'vehicle_brands.id', '=', 'vehicle_models.brand_id')
                ->paginate(10);

       return [
           'pagination_year' => [
               'total'         => $years->total(),
               'current_page'  => $years->currentPage(),
               'per_page'      => $years->perPage(),
               'last_page'     => $years->lastPage(),
               'from'          => $years->firstItem(),
               'to'            => $years->lastItem(),
           ],
           'vehicleyears' => $years
       ];

   }

   public function selectYears()
   {
        $years = VehicleYear::orderBy('id', 'ASC')->get();

        return $years;
   }

   public function ym($model)
    {
        $years = VehicleYear::select('id','v_year')->where('v_id', '=', $model)->get();

        return $years;
    }

}
