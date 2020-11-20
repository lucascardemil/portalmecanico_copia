<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $filename = str_replace(url('/storage'), "", $image->url);

        unlink( storage_path().$filename );


        // unlink(storage_path('img/vehicles/') . $filename );

        $image->delete();

        return;
    }


    public function upload(Request $request)
    {
        $arreglo = array();
        $uploadedFile = $request->pics;
        $id =  $request->id;

        $manager = new ImageManager(array('local' => 'imagick'));

        foreach ($uploadedFile as $file){
            $filename = time().'.'.$file->getClientOriginalExtension();
            $path = storage_path('img/vehicles/'.$filename);
            $img = $manager->make($file->getRealPath());
            $img->resize(800,800, function($constraint){
                $constraint->aspectRatio();
            })->save($path);
            //url de comercialsupra.cl/registro
            $url = url('storage/img/vehicles/'.$filename);
            //url original sin subcarpeta
            //$url = url('img/vehicles/'.$filename);
            Image::create(['detail_vehicle_id' => $id, 'url' => $url]);

            array_push($arreglo, $path);
        }



        return response($arreglo);
    }
}
