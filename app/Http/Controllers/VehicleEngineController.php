<?php

namespace App\Http\Controllers;

use App\VehicleEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleEngineController extends Controller
{

    public function all($brand, $model, $year){
        $engines = VehicleEngine::select(DB::raw('vehicle_engines.id as id, vehicle_engines.v_engine as engine'))
                                    ->join('vehicle_years', 'vehicle_years.id', '=', 'vehicle_engines.year_id')
                                    ->join('vehicle_brand_models', 'vehicle_brand_models.id', '=', 'vehicle_years.v_id')
                                    ->where([
                                        ['vehicle_years.v_year', '=', $year],
                                        ['vehicle_brand_models.brand', '=', $brand],
                                        ['vehicle_brand_models.model', '=', $model]
                                    ])->get();

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

}
