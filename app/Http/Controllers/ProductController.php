<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\TipoPago;
use App\ProductPago;
use App\Descuento;
use App\Code;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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

        $products = Product::with('productpagos', 'codes', 'client')
                    ->whereHas('codes.client', function ($query) use($idUser) {
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

        $tipospagos =  TipoPago::select('utilidad')->where('pago', 'DEFECTO')->get();
        
        ProductPago::create([
            'product_id' => $product,
            'forma_pago' => 'Venta',
            'utilidad' => $tipospagos[0]->utilidad
        ]);
        
        return $tipospagos;
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
        // $product = Product::whereHas('codes.client', function ($query) use($idUser) {
        //     $query->where('clients.user_id', '=', $idUser);
        // })->orderBy('id', 'DESC')->groupBy('name')->get();

        // return $product;


        

        $product = DB::table('clients')
            
            ->join('codes', 'clients.id', '=', 'codes.client_id')
            ->join('products', 'codes.product_id', '=', 'products.id')
            ->join('inventories', 'codes.id', '=', 'inventories.code_id')
            ->join('product_pagos', 'products.id', '=', 'product_pagos.product_id')
            ->select(DB::raw('max(inventories.fecha_fact)'), 'products.name', 'inventories.price', 'codes.id as code_id', 'inventories.id as inventory_id', 'inventories.quantity', 'product_pagos.utilidad')
            ->where('clients.user_id', '=', $idUser)
            ->where('inventories.quantity', '>', 0)
            ->groupBy('inventories.code_id')
            ->get();
            
        
        return $product;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTipoPago(Request $request)
    {
        $data = $request->all();
        $idUser = Auth::id();

        TipoPago::create([
            'user_id' => $idUser,
            'pago' => $data['pago'],
            'utilidad' => 0
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaTiposPagos()
    {
        $tipospagos = TipoPago::where('pago' , '<>', 'DEFECTO')->get();

        return $tipospagos;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateTiposPagos(Request $request, $id)
    {
        $data = $request->all();

        $productpago = ProductPago::where('product_id', $id)->update([
            'forma_pago' => $data['pago'],
            'utilidad' => $data['utilidad']
        ]);

        if(empty($productpago)){
            ProductPago::create([
                'product_id' => $data['id'],
                'forma_pago' => $data['pago'],
                'utilidad' => $data['utilidad']
            ]);
        }

        return;
    }


    public function allPagos()
    {
        $pagos = TipoPago::where('pago' , '<>', 'DEFECTO')->orderBy('id', 'ASC')->get();

        return $pagos;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateUtilidad(Request $request, $id)
    {
        TipoPago::find($id)->update($request->all());

        return;
    }

    // public function uploadProducts(Request $request)
    // {
    //     $request->validate([
    //         'import_file' => 'required|file|mimes:xls,xlsx'
    //     ]);

    //     $path = $request->file('import_file');
    //     $data = $request->all();

    //     $import = new ProductImport;

    //     Excel::import($import, $path);

    //     foreach($import->products as $product){
    //         Code::create([
    //             'client_id' => $data['client'],
    //             'product_id' => $product->id,
    //             'codebar' => $product->detail, 
    //             'is_activate' => 1              
    //         ]);
            
    //         ProductPago::create([
    //             'product_id' => $product->id,
    //             'forma_pago' => $data['pago'],
    //             'utilidad' => $data['utilidad']
    //         ]);

    //     }
        
    //     return response()->json(['message' => 'uploaded successfully'], 200);

    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDescuento(Request $request)
    {
        $data = $request->all();
        $idUser = Auth::id();

        $descuentos = Descuento::where('user_id', $idUser)->count();

        if($descuentos > 0){
            Descuento::where('user_id', $idUser)->update($request->all());
        }else{
            Descuento::create([
                'user_id' => $idUser,
                'descuento' => $data['descuento']
            ]);
        }

        
    }

    public function descuentoDefect()
    {
        $idUser = Auth::id();
        $descuento = Descuento::where('user_id', $idUser)->get();

        return $descuento;
    }

    
}
