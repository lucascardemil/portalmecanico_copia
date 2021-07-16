@extends('layoutsale')

@section('content')

    <h5></h5>
    <table class="table">
        
        <tbody>
            <?php $totalServicio = 0; ?>
            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Recibo</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" >{{ $sales->id }}</td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Direccion</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" >{{ $client->address }}</td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Telefono</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" >{{ $client->phone }}</td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Fecha</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" >{{ $sales->updated_at }}</td>
            </tr>
            
            <tr>
                <td colspan="" style="border-bottom: 0px" >Empleado</td>
                <td style="border-bottom: 0px" width="150px"></td>
                <td style="border-bottom: 0px" width="150px">{{ $user->name }}</td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px" >Cliente</td>
                <td style="border-bottom: 0px" width="150px"></td>
                <td style="border-bottom: 0px" width="150px">{{ $client->name }}</td>
            </tr>
         
            @foreach($product_sales as $product_sale)
            <tr>
                <td colspan="3">{{ $products->name }}</td>
            </tr>
            <tr>
                <td style="border-top: 0px">
                    <ul>
                        <li>{{ $product_sale->quantity }} X ${{ number_format($product_sale->price, 0,',','.') }}</li>
                    </ul>
                </td>
                <td style="border-top: 0px" width="150px"></td>
                <td style="border-top: 0px" width="150px">${{ number_format($product_sale->price, 0,',','.') }}</td>
                <?php $totalServicio += round(((floatval($product_sale->price * $product_sale->quantity)) * floatval($product_sale->utility)) + floatval($product_sale->price * $product_sale->quantity)) ?>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table">
        
        <tbody>
            <tr>
                
                <th>NETO</th>
                <td width="150px"></td>
                <th width="150px">${{ number_format($totalServicio,0,',','.') }}</th>
            </tr>
            <tr>
                
                <th style="border-top: 0px">IVA</th>
                <td style="border-top: 0px"  width="150px"></td>
                <th style="border-top: 0px" width="150px">${{ number_format($totalServicio * 0.19,0,',','.') }}</th>
            </tr>
            <tr>
         
                <th style="border-top: 0px">TOTAL</th>
                <td style="border-top: 0px" width="150px"></td>
                <th style="border-top: 0px" width="150px">${{ number_format($totalServicio * 1.19,0,',','.') }}</th>
            </tr>
            </tbody>
    </table>
@endsection
