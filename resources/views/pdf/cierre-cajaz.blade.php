@extends('layoutcajaZ')

@section('content')


<table>
    <tbody>
        
            <tr>
                <td colspan="2" style="border: 0px; padding-bottom: 10px;"><b>{{ $clients[0]->client_razonSocial }}</b></td>
            </tr>
            

            <tr>
                <td style="border: 0px;" >Direccion</td>
                <td style="border: 0px;" >{{ $clients[0]->client_address }}</td>
            </tr>

            <tr>
                <td style="border: 0px;" >Telefono</td>
                
                <td style="border: 0px;" >{{ $clients[0]->client_phone }}</td>
            </tr>

            <tr>
                <td style="border: 0px;" >Fecha</td>
                <td style="border: 0px;" >{{ $clients[0]->sale_updated_at }}</td>
            </tr>
            
            <tr>
                <td style="border: 0px;" >Empleado</td>
                <td style="border: 0px;">{{ $clients[0]->user_name }}</td>
            </tr>
        
    </tbody>
</table>
<hr>

<table>
    <tbody>
        <?php $totalServicio = 0; ?>
        @foreach ($products as $product)
            <tr>
                <td style="border: 0px;" colspan="2">{{ $product->name }}</td>
            </tr>
            
            <tr>
                <td style="border: 0px;" width="600px">{{ $product->quantity }} X ${{ number_format($product->price, 0,',','.') }}</td>
                <td style="border: 0px;">${{ number_format(round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)), 0,',','.') }}</td>
                <?php $totalServicio += round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)) ?>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<table>
    <tbody>
        <tr>
            
            <th style="border: 0px;" width="600px">NETO</th>
            <th style="border: 0px;">${{ number_format($totalServicio,0,',','.') }}</th>
        </tr>
        <tr>
            
            <th style="border: 0px;" width="600px">IVA</th>
            <th style="border: 0px;">${{ number_format($totalServicio * 0.19,0,',','.') }}</th>
        </tr>
        <tr>
        
            <th style="border: 0px;" width="600px">TOTAL</th>
            <th style="border: 0px;">${{ number_format($totalServicio * 1.19,0,',','.') }}</th>
        </tr>
    </tbody>
</table>





@endsection
