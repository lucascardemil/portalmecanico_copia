<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Code;
use App\Inventory;
use App\Sale;
use App\Client;
use App\ProductSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $idUser = Auth::id();
        $search = request('calendar');

        

        if($search == "null" || $search == null){
            $sale = Sale::with('client', 'products')->where('user_id', '=', $idUser)->get();
        }else{
            $sale = Sale::with('client', 'products')->where('user_id', '=', $idUser)->whereRaw("DATE_FORMAT(updated_at, '%Y-%m-%d') = ?", [$search])->get();
        }
        


        // if($search == null){
        //     $sale = DB::table('sales')
        //     ->join('clients', 'clients.id', '=', 'sales.client_id')
        //     ->join('productsales', 'sales.id', '=', 'productsales.sale_id')
        //     ->select('sales.*', 'productsales.*')
        //     ->where('sales.user_id', '=', $idUser)
        //     ->get();

        // }else{
        //     $sale = DB::table('sales')
        //     ->join('clients', 'clients.id', '=', 'sales.client_id')
        //     ->join('productsales', 'sales.id', '=', 'productsales.sale_id')
        //     ->select('sales.*', 'productsales.*')
        //     ->where('sales.user_id', '=', $idUser)
        //     ->where(DB::raw("(DATE_FORMAT(sales.updated_at, '%Y-%m-%d'))"), $search)
        //     ->get();

        // }

        return $sale;
    }

    public function sale(Request $request) {

        $saleData = $request->sale;
        $clients = Client::where('user_id', '=', Auth::user()->id)->where('type', '=', 'Cliente Particular')->get();

        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'client_id' => $clients[0]->id,
            'total' => $saleData['total']
        ]);

        $productsData = $request->products;

        for ($i=0; $i<count($productsData); $i++){
            
            ProductSale::create([
                'sale_id' => $sale->id,
                'code_id' => $productsData[$i]['product']['code_id'],
                'price' => $productsData[$i]['product']['price'],
                'utility' => floatval($productsData[$i]['utility']/100),
                'quantity' => $productsData[$i]['quantity']
            ]);

            $inv = Inventory::where('id', $productsData[$i]['product']['inventory_id'])->get('quantity');

            Inventory::where('price', $productsData[$i]['product']['price'])->update([
                'quantity' => $inv[0]->quantity - $productsData[$i]['quantity']
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



    public function all()
    {
        $idUser = Auth::id();
        $product = DB::table('clients')
            
            ->join('codes', 'clients.id', '=', 'codes.client_id')
            ->join('products', 'codes.product_id', '=', 'products.id')
            ->join('inventories', 'codes.id', '=', 'inventories.code_id')
            ->select(DB::raw('max(inventories.fecha_fact)'), 'products.name', 'inventories.price', 'codes.id as code_id', 'inventories.id as inventory_id', 'inventories.quantity')
            ->where('clients.user_id', '=', $idUser)
            ->where('inventories.quantity', '>', 0)
            ->groupBy('inventories.code_id')
            ->get();
            
        
        return $product;
    }
}
