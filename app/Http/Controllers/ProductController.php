<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUser = Auth::id();
        $products = Product::whereHas('codes.client', function ($query) use($idUser) {
            $query->where('clients.user_id', '=', $idUser);
        })->name()->orderBy('id', 'DESC')->paginate(10);

        return [
            'pagination' => [
                'total'         => $products->total(),
                'current_page'  => $products->currentPage(),
                'per_page'      => $products->perPage(),
                'last_page'     => $products->lastPage(),
                'from'          => $products->firstItem(),
                'to'            => $products->lastItem(),
            ],
            'products' => $products
        ];
    }

    public function products()
    {
        $userId = Auth::id();
        $products = Product::with('codes')->get();
        return $products;
    }

    public function codes(Product $product){
        return $product->codes;
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

        $product = Product::create(
            [
                'name' => $data['name'],
                'detail' => $data['detail']                
            ])->id;

        $code = Code::create(
            [
                'client_id' => $data['client_id'],
                'product_id' => $product,
                'codebar' => $data['codebar'], 
                'is_activate' => 1              
            ]);
        
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre_edit' => 'required',
            'detalle_edit' => 'required'
        ], [
            'nombre_edit.required' => 'El campo nombre es obligatorio',
            'detalle_edit.required' => 'El campo detalle electrónico es obligatorio'
        ]);

        Product::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return;
    }

    public function all()
    {
        $idUser = Auth::id();
        $product = Product::whereHas('codes.client', function ($query) use($idUser) {
            $query->where('clients.user_id', '=', $idUser);
        })->orderBy('id', 'DESC')->get();

        return $product;


        // $product = DB::table('clients')
        //     ->join('codes', 'clients.id', '=', 'codes.client_id')
        //     ->join('products', 'codes.product_id', '=', 'products.id')
        //     ->join('inventories', 'codes.id', '=', 'inventories.code_id')
        //     ->where('clients.user_id', '=', $idUser)
        //     ->select('products.name', 'inventories.price')
        //     ->orderBy('products.id', 'DESC')->get();
        
        // return $product;
    }
}
