<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use Illuminate\Http\Request;

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
        $products = Product::/*whereHas('codes.client', function ($query) use($idUser) {
            $query->where('clients.user_id', '=', $idUser);
        })->*/name()->orderBy('id', 'DESC')->paginate(10);

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

        $product = Product::create($data);

        return $product->id;
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
        $product = Product::whereHas('codes.client', function ($query) use($idUser) {
            $query->where('clients.user_id', '=', $idUser);
        })->orderBy('id', 'DESC')->get();

        return $product;
    }
}
