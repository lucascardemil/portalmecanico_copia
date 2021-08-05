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
                
                @if ($client->descuento > 0)
                <td style="border: 0px;">{{ $product->quantity }} X ${{ round((($product->price * $product->utility) + $product->price) - ((($product->price * $product->utility) + $product->price) * $client->descuento)) }}</td>
                @else
                <td style="border: 0px;">{{ $product->quantity }} X ${{ round(($product->price * $product->utility) + $product->price) }}</td>
                @endif
                <td style="border: 0px;" width="50px"></td>
                @if ($client->descuento > 0)
                <td style="border: 0px;" width="50px">${{ round(((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) - (((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) * $client->descuento)) }}</td>
                @else
                <td style="border: 0px;" width="50px">${{ round((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) }}</td>
                @endif
                <?php $totalServicio += round((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) ?>
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
            @if ($client->descuento > 0)
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio - ($totalServicio * $client->descuento),0,',','.') }}</th>
            @else
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio ,0,',','.') }}</th>
            @endif
        </tr>
        <tr>
            
            <th style="border: 0px;">IVA</th>
            <td style="border: 0px;" width="50px"></td>
            @if ($client->descuento > 0)
            <th style="border: 0px;" width="50px">${{ number_format(($totalServicio * 0.19) - (($totalServicio * 0.19) * $client->descuento),0,',','.') }}</th>
            @else
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio * 0.19,0,',','.') }}</th>
            @endif
        </tr>
        <tr>
        
            <th style="border: 0px;">TOTAL</th>
            <td style="border: 0px;" width="50px"></td>
            @if ($client->descuento > 0)
            <th style="border: 0px;" width="50px">${{ number_format(($totalServicio * 1.19) - (($totalServicio * 1.19) * $client->descuento),0,',','.') }}</th>
            @else
            <th style="border: 0px;" width="50px">${{ number_format($totalServicio * 1.19,0,',','.') }}</th>
            @endif
        </tr>
    </tbody>
</table>





@endsection
