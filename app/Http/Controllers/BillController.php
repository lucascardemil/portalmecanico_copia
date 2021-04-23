<?php

namespace App\Http\Controllers;

use Auth;
use App\Code;
use App\Client;
use App\Http\Requests\InvoiceRequest;
use App\Inventory;
use App\Product;
use DateTime;
use Illuminate\Http\Request;
use Services\InvoiceGenerateService;
use SimpleXMLElement;

class BillController extends Controller
{
    protected function contains($string, $find)
    {
        if (strpos($string, $find) !== false)
            return true;
        else return false;
    }

    protected function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    public function all()
    {
        //composer require smalot/pdfparser
        $parser = new \Smalot\PdfParser\Parser();

        #$pdf = $parser->parseFile(storage_path().'/app/bills/'.'e3nbwNfr0mi79aTns0Kni7tzqlgHMxINayP3rnfR.pdf'); //refax
        #$pdf = $parser->parseFile(storage_path().'/app/bills/'.'qwK3H6IwN7Nk7Ln5J2hHiy4KxrSnqFhTKiVNwWcx.pdf'); //blanford
        $pdf = $parser->parseFile(storage_path() . '/app/bills/' . 'NZVOUp7DqtP101zaN30oE5sJX0eOxzwBAna8yOLy.pdf'); //nestle
        #$pdf = $parser->parseFile(storage_path().'/app/bills/'.'anrDBSZYN376Amgwot88AEUpfyTxcvu2kzALW3ST.pdf'); //manheim



        $text = $pdf->getText();
        $lines = explode("\n", $text);

        $ruts = $productos = $codigos = $precios = $valores = $cantidades = $descripciones = array();
        $fecha = '';
        $neto = $iva = $total = 0;

        foreach ($lines as $line) {
            echo $line;
            echo "<br>";
        }
    }

    public function test()
    {
        //composer require smalot/pdfparser
        $parser = new \Smalot\PdfParser\Parser();

        #$pdf = $parser->parseFile(storage_path().'/app/bills/'.'e3nbwNfr0mi79aTns0Kni7tzqlgHMxINayP3rnfR.pdf'); //refax
        #$pdf = $parser->parseFile(storage_path().'/app/bills/'.'qwK3H6IwN7Nk7Ln5J2hHiy4KxrSnqFhTKiVNwWcx.pdf'); //blanford
        #$pdf = $parser->parseFile(storage_path().'/app/bills/'.'NZVOUp7DqtP101zaN30oE5sJX0eOxzwBAna8yOLy.pdf'); //nestle
        $pdf = $parser->parseFile(storage_path() . '/app/bills/' . 'anrDBSZYN376Amgwot88AEUpfyTxcvu2kzALW3ST.pdf'); //manheim



        $text = $pdf->getText();
        $lines = explode("\n", $text);

        $ruts = $productos = $codigos = $precios = $valores = $cantidades = $descripciones = array();
        $fecha = '';
        $neto = $iva = $total = 0;

        // foreach ($lines as $line){
        //     echo $line;
        //     echo "<br>";
        // }

        foreach ($lines as $i => $line) {
            if ($this->contains($line, "R.U.T.:")) {
                $rut = str_replace(".", "", substr($line, -12));
                $ruts[] = $rut;
            }
            if ($this->contains($line, "Fecha Emision:"))
                //pasa la fecha a formato de base de datos
                $fecha = str_replace("Fecha Emision: ", "", str_replace(" de ", "-", str_replace(" del ", "-", $line)));
            //seccion productos
            if ($this->contains($line, "Valor")) {
                //los productos deben comenzar bajo la linea "Valor"
                $j = $i + 1;
                //se itera sobre todos los productos hasta encontrar "Referencias" que es donde no hay mas productos
                while (true) {
                    //se verifica si existe el elemento que estamos iterando en el array de productos (lineas)
                    if (array_key_exists($j, $lines)) {
                        $producto = $lines[$j];
                        if ($this->contains($producto, "Referencias:") or $this->contains($producto, "Timbre Electrónico SII"))
                            break 1;
                        else {
                            //se debe dividir la linea para obtener el codigo, descripcion, cantidad, precio y valor
                            $detalles = explode(" ", $producto);
                            $descripcion = $codigo = '';
                            $cantidad = $precio = $valor = 0;

                            if ($this->startsWith($producto, "INT") or $this->startsWith($producto, 'Int')) {
                                $codigo = $detalles[0];
                                $len = count($detalles);
                                $valor = str_replace(".", "", $detalles[$len - 1]);
                                $precio = intval(str_replace(",", ".", str_replace(".", "", $detalles[$len - 2])));
                                $cantidad = preg_replace("/[^0-9]/", "", $detalles[$len - 3]);

                                if ($precio > $valor) {
                                    $cantidad = $detalles[$len - 2][0];
                                    $precio = str_replace(".", "", ltrim($detalles[$len - 2], $detalles[$len - 2][0]));

                                    for ($k = 1; $k < $len - 2; $k++) {
                                        $descripcion = $descripcion . ' ' . $detalles[$k];
                                    }
                                } else {
                                    for ($k = 1; $k < $len - 3; $k++) {
                                        $descripcion = $descripcion . ' ' . $detalles[$k];
                                    }
                                }
                            }

                            if (array_key_exists($j + 1, $lines)) {
                                if (!$this->startsWith($lines[$j + 1], "INT") or !$this->startsWith($lines[$j + 1], 'Int')) {
                                    $prod = explode(" ", $lines[$j + 1]);
                                    $prod_ant = explode(" ", $lines[$j]);
                                    if (count($prod) == 2) {
                                        if (is_numeric($prod[0]) and is_numeric($prod[1])) {
                                            $x = $j;
                                            while (true) {
                                                if (array_key_exists($x, $lines)) {
                                                    if ($this->startsWith($lines[$x], "INT") or $this->startsWith($lines[$x], 'Int')) {
                                                        $p = explode(" ", $lines[$x]);
                                                        $codigo = $p[0];
                                                        $descripcion = '';
                                                        for ($y = 1; $y < count($p); $y++) {
                                                            $descripcion = $descripcion . ' ' . $p[$y];
                                                        }
                                                        break 1;
                                                    }
                                                    $x--;
                                                } else break 1;
                                            }

                                            $precio = str_replace(",", ".", str_replace(".", "", $prod[0]));
                                            $valor = str_replace(".", "", $prod[1]);
                                            $cantidad = $prod_ant[count($prod_ant) - 1];
                                            $m = $j - 1;

                                            for ($w = 0; $w < count($prod_ant) - 1; $w++) {
                                                $descripcion = $descripcion . ' ' . $prod_ant[$w];
                                            }
                                            while (true) {

                                                if (array_key_exists($m, $lines)) {
                                                    if ($this->startsWith($lines[$m], 'INT') or $this->startsWith($lines[$m], 'Int')) {
                                                        break 1;
                                                    } else if (!$this->startsWith($lines[$m], 'INT') or !$this->startsWith($lines[$m], 'Int')) {

                                                        $d = explode(" ", $lines[$m]);

                                                        for ($o = 0; $o < count($d); $o++) {
                                                            $descripcion = $descripcion . ' ' . $d[$o];
                                                        }
                                                    }
                                                    $m--;
                                                } else break 1;
                                            }
                                        }
                                    }
                                }
                            }

                            if (!empty($codigo) and !empty($descripcion) and $cantidad > 0 and $precio > 0 and $valor > 0) {
                                $codigos[] = $codigo;
                                $precios[] = $precio;
                                $valores[] = $valor;
                                $cantidades[] = $cantidad;
                                $descripciones[] = $descripcion;

                                // echo $codigo;
                                // echo "<br>";
                                // echo $descripcion;
                                // echo "<br>";
                                // echo $cantidad;
                                // echo "<br>";
                                // echo $precio;
                                // echo "<br>";
                                // echo $valor;
                                // echo "<br>";
                            }


                            $productos['codigo'] = $codigos;
                            $productos['precio'] = $precios;
                            $productos['valor'] = $valores;
                            $productos['cantidad'] = $cantidades;
                            $productos['descripcion'] = $descripciones;
                            $j++;
                        }
                    } else break 1;
                }
            }
            //el monto neto aparece bajo la linea "MONTO NETO"
            if ($this->contains($line, "MONTO NETO"))
                $monto = str_replace("$", "", str_replace(".", "", $lines[$i + 1]));
            if ($this->contains($line, "I.V.A. 19% $"))
                $iva = str_replace("IVA 19% $", "", str_replace(".", "", $line));
            if ($this->contains($line, "TOTAL $"))
                $total = str_replace("TOTAL $", "", str_replace(".", "", $line));
        }

        if (!empty($productos)) {

            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://dev-api.haulmer.com/v2/dte/taxpayer/' . $ruts[1], ['headers' => ['apiKey' => '928e15a2d14d4a6292345f04960f4bd3']]);
            if ($res->getStatusCode() == 200) {
                $obj = json_decode($res->getBody(), true);

                $data = [
                    'user_id' => Auth::id(),
                    'name' => $obj['razonSocial'],
                    'rut' => $ruts[1],
                    'razonSocial' => $obj['razonSocial'],
                    'email' => $obj['email'],
                    'phone' => $obj['telefono'],
                    'address' => $obj['direccion'],
                    'comuna' => $obj['comuna'],
                    'giro' => $obj['actividades'][0]['giro'],
                    'type' => 'Proveedor'
                ];

                $client = Client::firstOrCreate($data);

                for ($x = 0; $x < count($productos['codigo']); $x++) {
                    $product_data = [
                        'name' => $productos['descripcion'][$x],
                        'detail' => $productos['codigo'][$x]
                    ];

                    $product = Product::firstOrCreate($product_data);

                    $code_data = [
                        'client_id' => $client->id,
                        'product_id' => $product->id,
                        'codebar' => $productos['codigo'][$x]
                    ];

                    $code = Code::firstOrCreate($code_data);

                    $inventory_data = [
                        'code_id' => $code->id,
                        'price' => $productos['precio'][$x],
                        'quantity' => $productos['cantidad'][$x]
                    ];

                    $inventory = Inventory::firstOrCreate($inventory_data);
                }
                return response()->json('Success', 200);
            }
        } else return response()->json('Failure', 422);



        // echo $ruts[1];
        // echo "<br>";
        // echo $fecha;
        // echo "<br>";
        // for ( $x=0; $x<count($productos['codigo']); $x++) {
        //     echo $productos['codigo'][$x];
        //     echo "<br>";
        //     echo $productos['descripcion'][$x];
        //     echo "<br>";
        //     echo $productos['cantidad'][$x];
        //     echo "<br>";
        //     echo $productos['precio'][$x];
        //     echo "<br>";
        //     echo $productos['valor'][$x];
        //     echo "<br>";
        // }

        // echo $monto;
        // echo "<br>";
        // echo $iva;
        // echo "<br>";
        // echo $total;


    }

    protected function store($path)
    {
        // //composer require smalot/pdfparser
        // $parser = new \Smalot\PdfParser\Parser();

        // $pdf = $parser->parseFile(storage_path() . '/app/' . $path);

        // $text = $pdf->getText();
        // $lines = explode("\n", $text);

        // $ruts = $productos = $codigos = $precios = $valores = $cantidades = $descripciones = array();
        // $fecha = '';
        // $neto = $iva = $total = 0;

        // foreach ($lines as $i => $line) {
        //     if ($this->contains($line, "R.U.T.:")) {
        //         $rut = str_replace(".", "", substr($line, -12));
        //         $ruts[] = $rut;
        //     }
        //     if ($this->contains($line, "Fecha Emision:"))
        //         //pasa la fecha a formato de base de datos
        //         $fecha = str_replace("Fecha Emision: ", "", str_replace(" de ", "-", str_replace(" del ", "-", $line)));
        //     //seccion productos
        //     if ($this->contains($line, "Valor")) {
        //         //los productos deben comenzar bajo la linea "Valor"
        //         $j = $i + 1;
        //         //se itera sobre todos los productos hasta encontrar "Referencias" que es donde no hay mas productos
        //         while (true) {
        //             //se verifica si existe el elemento que estamos iterando en el array de productos (lineas)
        //             if (array_key_exists($j, $lines)) {
        //                 $producto = $lines[$j];
        //                 if ($this->contains($producto, "Referencias:") or $this->contains($producto, "Timbre Electrónico SII"))
        //                     break 1;
        //                 else {
        //                     //se debe dividir la linea para obtener el codigo, descripcion, cantidad, precio y valor
        //                     $detalles = explode(" ", $producto);
        //                     $descripcion = $codigo = '';
        //                     $cantidad = $precio = $valor = 0;

        //                     if ($this->startsWith($producto, "INT") or $this->startsWith($producto, 'Int')) {
        //                         $codigo = $detalles[0];
        //                         $len = count($detalles);
        //                         $valor = str_replace(".", "", $detalles[$len - 1]);
        //                         $precio = intval(str_replace(",", ".", str_replace(".", "", $detalles[$len - 2])));
        //                         $cantidad = preg_replace("/[^0-9]/", "", $detalles[$len - 3]);

        //                         if ($precio > $valor) {
        //                             $cantidad = $detalles[$len - 2][0];
        //                             $precio = str_replace(".", "", ltrim($detalles[$len - 2], $detalles[$len - 2][0]));

        //                             for ($k = 1; $k < $len - 2; $k++) {
        //                                 $descripcion = $descripcion . ' ' . $detalles[$k];
        //                             }
        //                         } else {
        //                             for ($k = 1; $k < $len - 3; $k++) {
        //                                 $descripcion = $descripcion . ' ' . $detalles[$k];
        //                             }
        //                         }
        //                     }

        //                     if (array_key_exists($j + 1, $lines)) {
        //                         if (!$this->startsWith($lines[$j + 1], "INT") or !$this->startsWith($lines[$j + 1], 'Int')) {
        //                             $prod = explode(" ", $lines[$j + 1]);
        //                             $prod_ant = explode(" ", $lines[$j]);
        //                             if (count($prod) == 2) {
        //                                 if (is_numeric($prod[0]) and is_numeric($prod[1])) {
        //                                     $x = $j;
        //                                     while (true) {
        //                                         if (array_key_exists($x, $lines)) {
        //                                             if ($this->startsWith($lines[$x], "INT") or $this->startsWith($lines[$x], 'Int')) {
        //                                                 $p = explode(" ", $lines[$x]);
        //                                                 $codigo = $p[0];
        //                                                 $descripcion = '';
        //                                                 for ($y = 1; $y < count($p); $y++) {
        //                                                     $descripcion = $descripcion . ' ' . $p[$y];
        //                                                 }
        //                                                 break 1;
        //                                             }
        //                                             $x--;
        //                                         } else break 1;
        //                                     }

        //                                     $precio = str_replace(",", ".", str_replace(".", "", $prod[0]));
        //                                     $valor = str_replace(".", "", $prod[1]);
        //                                     $cantidad = $prod_ant[count($prod_ant) - 1];
        //                                     $m = $j - 1;

        //                                     for ($w = 0; $w < count($prod_ant) - 1; $w++) {
        //                                         $descripcion = $descripcion . ' ' . $prod_ant[$w];
        //                                     }
        //                                     while (true) {

        //                                         if (array_key_exists($m, $lines)) {
        //                                             if ($this->startsWith($lines[$m], 'INT') or $this->startsWith($lines[$m], 'Int')) {
        //                                                 break 1;
        //                                             } else if (!$this->startsWith($lines[$m], 'INT') or !$this->startsWith($lines[$m], 'Int')) {

        //                                                 $d = explode(" ", $lines[$m]);

        //                                                 for ($o = 0; $o < count($d); $o++) {
        //                                                     $descripcion = $descripcion . ' ' . $d[$o];
        //                                                 }
        //                                             }
        //                                             $m--;
        //                                         } else break 1;
        //                                     }
        //                                 }
        //                             }
        //                         }
        //                     }

        //                     if (!empty($codigo) and !empty($descripcion) and $cantidad > 0 and $precio > 0 and $valor > 0) {
        //                         $codigos[] = $codigo;
        //                         $precios[] = $precio;
        //                         $valores[] = $valor;
        //                         $cantidades[] = $cantidad;
        //                         $descripciones[] = $descripcion;
        //                     }

        //                     $productos['codigo'] = $codigos;
        //                     $productos['precio'] = $precios;
        //                     $productos['valor'] = $valores;
        //                     $productos['cantidad'] = $cantidades;
        //                     $productos['descripcion'] = $descripciones;
        //                     $j++;
        //                 }
        //             } else break 1;
        //         }
        //     }
        //     //el monto neto aparece bajo la linea "MONTO NETO"
        //     if ($this->contains($line, "MONTO NETO"))
        //         $monto = str_replace("$", "", str_replace(".", "", $lines[$i + 1]));
        //     if ($this->contains($line, "I.V.A. 19% $"))
        //         $iva = str_replace("IVA 19% $", "", str_replace(".", "", $line));
        //     if ($this->contains($line, "TOTAL $"))
        //         $total = str_replace("TOTAL $", "", str_replace(".", "", $line));
        // }

        // if (!empty($productos)) {

        //     $client = new \GuzzleHttp\Client();
        //     $res = $client->get('https://dev-api.haulmer.com/v2/dte/taxpayer/' . $ruts[1], ['headers' => ['apiKey' => '928e15a2d14d4a6292345f04960f4bd3']]);
        //     if ($res->getStatusCode() == 200) {
        //         $obj = json_decode($res->getBody(), true);

        //         $data = [
        //             'user_id' => Auth::id(),
        //             'name' => $obj['razonSocial'],
        //             'razonSocial' => $obj['razonSocial'],
        //             'email' => $obj['email'],
        //             'phone' => $obj['telefono'],
        //             'address' => $obj['direccion'],
        //             'comuna' => $obj['comuna'],
        //             'giro' => $obj['actividades'][0]['giro'],
        //             'type' => 'Proveedor'
        //         ];

        //         $client = Client::updateOrCreate(['rut' => $ruts[1]], $data);

        //         for ($x = 0; $x < count($productos['codigo']); $x++) {
        //             $product_data = [
        //                 'name' => $productos['descripcion'][$x],
        //                 'detail' => $productos['codigo'][$x]
        //             ];

        //             $product = Product::firstOrCreate($product_data);

        //             $code_data = [
        //                 'client_id' => $client->id,
        //                 'product_id' => $product->id,
        //                 'codebar' => $productos['codigo'][$x]
        //             ];

        //             $code = Code::firstOrCreate($code_data);

        //             $inventory_data = [
        //                 'code_id' => $code->id,
        //                 'price' => $productos['precio'][$x],
        //                 'quantity' => $productos['cantidad'][$x]
        //             ];

        //             $inventory = Inventory::firstOrCreate($inventory_data);
        //         }
        //         return response()->json('Success', 200);
        //     }
        // } else return response()->json('Failure', 422);
        
    }

    public function upload(Request $request)
    {

        //$path = $request->file('file')->store('bills');

        //$this->store($path);

        $path = $request->file('file');
        $xml = simplexml_load_file($path);

        $client_id = Client::updateOrCreate(
            ['rut' => $xml->DTE->Documento->Encabezado->Emisor[0]->RUTEmisor],
            [
                'user_id' => Auth::id(),
                'name' => $xml->DTE->Documento->Encabezado->Emisor[0]->RznSoc,
                'razonSocial' => $xml->DTE->Documento->Encabezado->Emisor[0]->RznSoc,
                'address' => $xml->DTE->Documento->Encabezado->Emisor[0]->DirOrigen,
                'comuna' => $xml->DTE->Documento->Encabezado->Emisor[0]->CmnaOrigen,
                'giro' => $xml->DTE->Documento->Encabezado->Emisor[0]->GiroEmis,
                'type' => 'Proveedor'
            ])->id;


        // $folios = Code::where('folio', '=' , $xml->DTE->Documento->Encabezado->IdDoc[0]->Folio)->get('folio');

              
        // if($xml->DTE->Documento->Encabezado->IdDoc[0]->Folio != isset($folios[0]->folio)){

        foreach ($xml->DTE->Documento->Detalle as $producto) {
            if(!empty($producto->CdgItem->TpoCodigo)){
                
                $count = Product::where('detail', $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo)->count();
                $detail = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $producto->NmbItem); //Elimina lo espacios en blanco

                if(empty($count)){
                    

                    $product = Product::firstOrCreate(
                        [
                            'name' => $detail,
                            'detail' => $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo
                        ]);
                    
                    

                    $code = Code::firstOrCreate(
                        [
                            'client_id' => $client_id,
                            'product_id' => $product->id,
                            'codebar' => $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo,
                            'fecha_fact' => $xml->DTE->Documento->Encabezado->IdDoc[0]->FchEmis,
                            'folio' => $xml->DTE->Documento->Encabezado->IdDoc[0]->Folio
                        ]);
                
            
                    Inventory::firstOrCreate(
                        [
                            'code_id' => $code->id,
                            'price' => round($producto->MontoItem / $producto->QtyItem),
                            'quantity' => $producto->QtyItem
                        ]);
                        
                    
                    
                    
                }else{

                    $products = Product::where('detail', $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo)->get();

                    foreach ($products as $product) {

                        $count = Code::where('codebar', $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo)->count();
                        if(empty($count)){
                            $code = Code::firstOrCreate(
                                [
                                    'client_id' => $client_id,
                                    'product_id' => $product->id,
                                    'codebar' => $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo,
                                    'fecha_fact' => $xml->DTE->Documento->Encabezado->IdDoc[0]->FchEmis,
                                    'folio' => $xml->DTE->Documento->Encabezado->IdDoc[0]->Folio
                                ]);
                            
                            Inventory::firstOrCreate(
                                [
                                    'code_id' => $code->id,
                                    'price' => round($producto->MontoItem / $producto->QtyItem),
                                    'quantity' => $producto->QtyItem
                                ]);
                            
                        }else{
                            $inventorys = Code::where('codebar', $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo)->get();
                            foreach($inventorys as $inventory){

                                if($inventory->codebar != $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo){

                                    $code = Code::firstOrCreate(
                                        [
                                            'client_id' => $client_id,
                                            'product_id' => $product->id,
                                            'codebar' => $producto->CdgItem->TpoCodigo.'-'.$producto->CdgItem->VlrCodigo,
                                            'fecha_fact' => $xml->DTE->Documento->Encabezado->IdDoc[0]->FchEmis,
                                            'folio' => $xml->DTE->Documento->Encabezado->IdDoc[0]->Folio
                                        ]);
                                }
                            
                            
                                if($inventory->atributo > 0){

                                    $cantidad = $producto->QtyItem * $inventory->atributo;
                                    $total = $producto->PrcItem * $producto->QtyItem;
                                    
                                    Inventory::create(
                                        [
                                            'code_id' => $inventory->id,
                                            'price' => $total / $cantidad,
                                            'quantity' => $cantidad
                                        ]);
                                    
                                }else{
                            
                                    Inventory::firstOrCreate(
                                        [
                                            'code_id' => $inventory->id,
                                            'price' => round($producto->MontoItem / $producto->QtyItem),
                                            'quantity' => $producto->QtyItem
                                        ]);
                                }
                            }
                        }
                    }
                }                        
            }
        }
    }

    /**
     * Recibe la informacion desde el admin-boletas
     * @param InvoiceRequest $request
     * @return void
     */
    public function getDataInvoice(InvoiceRequest $request)
    {
        $fecha = $request->fecha  === null ? new DateTime() : new DateTime($request->fecha);
        $date = $fecha->format('Y-m-d');
        $rut = $this->formatRut($request->rutReceptor);
        $totalInvoice = $request->sumaTotalBoleta;

        /** servicio generador de boleta electronica  */
        $invoice =  new InvoiceGenerateService();
        $invoice->setDate($date);
        $invoice->setRut($rut);
        $invoice->setTotal($totalInvoice);
        return  $invoice->generateBasicInvoice();
    }

    /**
     * Formatea el rut acorde al formato requerido para openfactura
     * @param string $partialRut
     * @return string $finalRut
     */
    public function formatRut($partialRut)
    {
        $rut = str_replace('-', '', str_replace('.', '', $partialRut));
        $verificatorDigit = substr($rut, -1);
        $numerRut = substr($rut, 0, -1);
        $finalRut =  $numerRut . "-" . $verificatorDigit;
        return $finalRut;
    }
}
