@extends('layoutsale')

@section('content')


<table class="table">
    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td style="border: 0px;" ><h5>{{ $client->client_razonSocial }}</h5></td>
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
<hr>

<table class="table">
    <tbody>
        <?php $totalServicio = 0; ?>
        @foreach ($products as $product)
            <tr>
                <td style="border: 0px;" colspan="3">{{ $product->name }}</td>
            </tr>
            
            <tr>
                <td style="border: 0px;">
                    <ul>
                        <li>{{ $product->quantity }} X ${{ number_format($product->price, 0,',','.') }}</li>
                    </ul>
                </td>
                <td style="border: 0px;" width="150px"></td>
                <td style="border: 0px;" width="150px">${{ number_format($product->price, 0,',','.') }}</td>
                <?php $totalServicio += round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)) ?>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<table class="table">
    <tbody>
        <tr>
            
            <th style="border: 0px;">NETO</th>
            <td style="border: 0px;" width="150px"></td>
            <th style="border: 0px;" width="150px">${{ number_format($totalServicio,0,',','.') }}</th>
        </tr>
        <tr>
            
            <th style="border: 0px;">IVA</th>
            <td style="border: 0px;" width="150px"></td>
            <th style="border: 0px;" width="150px">${{ number_format($totalServicio * 0.19,0,',','.') }}</th>
        </tr>
        <tr>
        
            <th style="border: 0px;">TOTAL</th>
            <td style="border: 0px;" width="150px"></td>
            <th style="border: 0px;" width="150px">${{ number_format($totalServicio * 1.19,0,',','.') }}</th>
        </tr>
    </tbody>
</table>





@endsection
