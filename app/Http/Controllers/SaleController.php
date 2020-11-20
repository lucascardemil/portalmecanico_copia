<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Code;
use App\Inventory;
use App\Sale;
use App\ProductSale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $sale = ProductSale::with('sale', 'codes')->get();
        $sale = Sale::with('client', 'products')->get();

        return $sale;
    }

    public function sale(Request $request) {
        $saleData = $request->sale;
        $saleData['user_id'] = Auth::user()->id;
        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'client_id' => $saleData['client_id'],
            'total' => $saleData['total']
        ]);

        $productsData = $request->products;

        for ($i=0; $i<count($productsData); $i++){
            $detail = [
                'sale_id' => $sale->id,
                'code_id' => $productsData[$i]['code']['value'],
                'price' => $productsData[$i]['price']['label'],
                'utility' => floatval($productsData[$i]['utility']/100),
                'quantity' => $productsData[$i]['quantity']
            ];
            $p = ProductSale::create($detail);
            $inv = Inventory::find($productsData[$i]['price']['value']);
            $inv->update([
                'quantity' => $inv->quantity - $productsData[$i]['quantity']
            ]);

        }
    }

    public function products($sale){
        return \DB::select(
        'select
            p.name as product, 
            c.codebar as code, 
            ps.utility as utility, 
            ps.quantity as quantity, 
            round(ps.price*ps.quantity*(1+ps.utility)*1.19) as total 
        from products as p inner join codes as c on p.id = c.product_id 
            inner join productsales as ps on c.id = ps.code_id and ps.sale_id = ?', array($sale));
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
        $data['user_id'] = Auth::user()->id;

        $sale = Sale::create($data);

        //$products = $request->products;

        return response()->json($sale, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());

        return response()->json($sale, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->json(null, 204);
    }
}
