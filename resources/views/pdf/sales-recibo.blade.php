@extends('layoutsale')

@section('content')

    <!-- <table class="table" style="border:none;">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td style="padding-top:25px;border:none;">
                    <img width="220" height="100"
                     src="http://comercialsupra.cl/wp-content/uploads/2019/05/logosupra-copia-2.jpg">
                </td>
                <td class="text-center"  style="padding-top:40px;border:none;">
                    <span style="font-size:24px">Recibo N°{{ $sales->id }}</span>
                </td>
            </tr>
        </tbody>
    </table> -->

    <table class="table table-bordered">
        <thead>
            <tr>
          
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalServicio = 0; ?>
         
            @foreach($product_sales as $product_sale)
            <tr>
                
                <td>{{ $products->name }}</td>
                <td width="150px">{{ $product_sale->quantity }}</td>
                <td width="150px">${{ number_format($product_sale->price, 0,',','.') }}</td>
                <?php $totalServicio += round(((floatval($product_sale->price * $product_sale->quantity)) * floatval($product_sale->utility)) + floatval($product_sale->price * $product_sale->quantity)) ?>
                
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table">
        
        <tbody>
            <tr>
                
                <td style="border-top: 0px solid #dee2e6">NETO</td>
                <td style="border-top: 0px solid #dee2e6" width="150px"></td>
                <td style="border-top: 0px solid #dee2e6" width="150px">${{ number_format($totalServicio,0,',','.') }}</td>
            </tr>
            <tr>
                
                <td>IVA</td>
                <td width="150px"></td>
                <td width="150px">${{ number_format($totalServicio * 0.19,0,',','.') }}</td>
            </tr>
            <tr>
         
                <th>TOTAL</th>
                <td width="150px"></td>
                <th width="150px">${{ number_format($totalServicio * 1.19,0,',','.') }}</th>
            </tr>
            </tbody>
    </table>


    <!-- <table class="table table-bordered">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td class="text-left">
                    <div style="font-size:16px">
                       Correo: comercialsupra4@gmail.com
                    </div>
                    <div style="font-size:16px">
                       Whatsapp: +56 9 8948 3379
                    </div>
                </td>
            </tr>
        </tbody>
    </table> -->

@endsection
