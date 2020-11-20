<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::with('client', 'product', 'inventories')->orderBy('id', 'DESC')->paginate(30);

        return [
            'pagination' => [
                'total'         => $codes->total(),
                'current_page'  => $codes->currentPage(),
                'per_page'      => $codes->perPage(),
                'last_page'     => $codes->lastPage(),
                'from'          => $codes->firstItem(),
                'to'            => $codes->lastItem(),
            ],
            'codes' => $codes
        ];
    }

    public function search ($code) {
        $search = Code::where('codebar', 'LIKE', '%'.$code.'%')->with(array(
            'inventories' => function ($query) {
                $query->orderBy('inventories.id', 'DESC');
                $query->where('inventories.quantity', '>', '0');
                $query->first();
            }, 'product'))
            ->first();

        return $search;
    }

    public function product(Code $code) {
        
        $product = $code->product;

        return $product;
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

        $code = Code::create($data);

        return $code->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $code = Code::find($id);

        return $code;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Code::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $code = Code::findOrFail($id);
        $code->delete();

        return;
    }

    public function inventories($id)
    {
        $inventories = Code::find($id)->inventories;

        return $inventories;
    }

}
