@extends('layoutsale')

@section('content')


<table>
    <tbody>
        @foreach ($clients as $client)
            <tr >
                <td colspan="2" style="border: 0px; padding-bottom: 10px;"><b>{{ $client->client_razonSocial }}</b></td>
            </tr>
            <tr>
                <td style="border: 0px;" >Recibo</td>
                
                <td style="border: 0px;" >{{ $client->sale_id }}</td>
            </tr>

            <tr>
                <td style="border: 0px;" >Direccion</td>
                <td style="border: 0px;" >{{ $client->client_address }}</td>
            </tr>

            <tr>
                <td style="border: 0px;" >Telefono</td>
                
                <td style="border: 0px;" >{{ $client->client_phone }}</td>
            </tr>

            <tr>
                <td style="border: 0px;" >Fecha</td>
                <td style="border: 0px;" >{{ $client->sale_updated_at }}</td>
            </tr>
            
            <tr>
                <td style="border: 0px;" >Empleado</td>
                <td style="border: 0px;">{{ $client->user_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr style="margin-bottom: 5px; margin-top: 5px;">

<table>
    <tbody>
        <?php $totalServicio = 0; ?>
        @foreach ($products as $product)
            <tr>
                <td style="border: 0px;" colspan="3">{{ $product->name }}</td>
            </tr>
            
            <tr>
                <td style="border: 0px;">{{ $product->quantity }} X ${{ number_format($product->price, 0,',','.') }}</td>
                <td style="border: 0px;" width="50px"></td>
                <td style="border: 0px;" width="50px">${{ number_format(round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)), 0,',','.') }}</td>
                <?php $totalServicio += round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)) ?>
            </tr>
        @endforeach
    </tbody>
</table>

<hr style="margin-bottom: 5px; margin-top: 5px;">

<table>
    <tbody>
        <tr>
            
            <th style="border: 0px;">NETO</th>
            <td style="border: 0px;" width="50px"></td>
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio,0,',','.') }}</th>
        </tr>
        <tr>
            
            <th style="border: 0px;">IVA</th>
            <td style="border: 0px;" width="50px"></td>
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio * 0.19,0,',','.') }}</th>
        </tr>
        <tr>
        
            <th style="border: 0px;">TOTAL</th>
            <td style="border: 0px;" width="50px"></td>
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio * 1.19,0,',','.') }}</th>
        </tr>
    </tbody>
</table>





@endsection
