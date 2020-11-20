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

}
