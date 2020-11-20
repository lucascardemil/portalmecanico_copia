<?php

namespace App\Http\Controllers;

use App\Detailimport;
use Illuminate\Http\Request;

class DetailimportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailimports = Detailimport::orderBy('id', 'DESC')->paginate(10);

        return $detailimports;
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

        Detailimport::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detailimport  $detailimport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailimport = Detailimport::find($id);

        return $detailimport;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detailimport  $detailimport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Detailimport::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detailimport  $detailimport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailimport = Detailimport::findOrFail($id);
        $detailimport->delete();

        return;
    }




}
