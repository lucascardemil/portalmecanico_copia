<?php

namespace App\Http\Controllers;

use Auth;
use App\Code;
use App\Inventory;
use App\TipoPago;
use App\Atributo;
use App\ProductPago;
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
        $idUser = Auth::id();
        // $codes = Code::with('client', 'product', 'inventories')
        // ->whereHas('client', function ($query) use($idUser) {
        //     $query->where('clients.user_id', '=', $idUser);
        // })->orderBy('id', 'DESC')->paginate(10);

        // return [
        //     'pagination' => [
        //         'total'         => $codes->total(),
        //         'current_page'  => $codes->currentPage(),
        //         'per_page'      => $codes->perPage(),
        //         'last_page'     => $codes->lastPage(),
        //         'from'          => $codes->firstItem(),
        //         'to'            => $codes->lastItem(),
        //     ],
        //     'codes' => $codes
        // ];



        $search = request('name');

        $codes = Code::with('client', 'product', 'inventories', 'productpagos')
        ->whereHas('client', function ($query) use($idUser) {
            $query->where('clients.user_id', '=', $idUser);
        })
        ->WhereHas('product', function ($query) use($search) {
            $query->where('products.name', 'LIKE', '%'.$search.'%');
        })->orderBy('id', 'DESC')->paginate(20);

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
        // Code::find($id)->update($request->all());
        
        // $inventory = Inventory::find($codes);
        // $inventory->quantity = $request->atributo;
        // $inventory->save();

        $code = Code::find($id);
        $code->codebar = $request->codebar;
        $code->atributo = $request->atributo;
        $code->save();

        // Atributo::create([
        //     'codigo' => $request->codebar,
        //     'atributo' => $request->atributo
        // ]);

        if($request->utilidad > 0){
            ProductPago::where('product_id', $code->product_id)->update([
                'forma_pago' => 'DEFECTO',
                'utilidad' => $request->utilidad
            ]);
        }


        if($request->atributo > 0){
            $inventorys = Inventory::where('code_id', $code->id)->get();
            foreach($inventorys as $inventory){
                if($request->atributo != $inventory->quantity){
                    $cantidad = $inventory->quantity * $request->atributo;
                    $total = $inventory->price * $inventory->quantity;
                    
                    Inventory::where('code_id', $code->id)->update([
                        'quantity' => $cantidad,
                        'price' => $total / $cantidad
                    ]);
                }
            }
        }

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


    public function updateUtilidadDefect(Request $request)
    {
        TipoPago::where('pago', 'DEFECTO')->update([
            'utilidad' => $request->utilidad
        ]);

        return;
    }

    public function utilidadDefect()
    {
        $utilidad = TipoPago::orderBy('id', 'ASC')->where('pago', 'DEFECTO')->get();

        return $utilidad;
    }
    

}
