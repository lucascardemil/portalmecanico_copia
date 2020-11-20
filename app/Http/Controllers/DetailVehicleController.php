<?php

namespace App\Http\Controllers;

use App\DetailVehicle;
use Illuminate\Http\Request;

class DetailVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalle = DetailVehicle::orderBy('id', 'DESC')->get();

        return $detalle;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //$data['user_id'] = 1;

        $detail = DetailVehicle::create($data);

        return $detail->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailVehicle  $detailVehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalle = DetailVehicle::find($id)->images;

        return $detalle;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetailVehicle  $detailVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailVehicle $detailVehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetailVehicle  $detailVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailVehicle $detailVehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetailVehicle  $detailVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailVehicle $detailVehicle)
    {
        //
    }
}
