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
        <?php $neto = 0; ?>
        <?php $iva = 0; ?>
        <?php $total = 0; ?>
        @foreach ($products as $product)
            <tr>
                <td style="border: 0px;" colspan="2">{{ $product->name }}</td>
            </tr>
            
            <tr>
                @if ($product->descuento > 0)
                <td style="border: 0px;" width="600px">{{ $product->quantity }} X ${{ round((($product->price * $product->utility) + $product->price) - ((($product->price * $product->utility) + $product->price) * $product->descuento)) }}</td>
                @else
                <td style="border: 0px;" width="600px">{{ $product->quantity }} X ${{ round(($product->price * $product->utility) + $product->price) }}</td>
                @endif
                @if ($product->descuento > 0)
                <td style="border: 0px;">${{ round(((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) - (((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) * $product->descuento)) }}</td>
                @else
                <td style="border: 0px;">${{ round((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) }}</td>
                @endif

                @if ($product->descuento > 0)
                <?php $neto += round((($product->price * $product->utility) + $product->price) - ((($product->price * $product->utility) + $product->price) * $product->descuento)) ?>
                @else
                <?php $neto += round(($product->price * $product->utility) + $product->price) ?>
                @endif

                @if ($product->descuento > 0)
                <?php $iva += round(((($product->price * $product->utility) + $product->price) * 0.19) - (((($product->price * $product->utility) + $product->price) * 0.19) * $product->descuento)) ?>
                @else
                <?php $iva += round((($product->price * $product->utility) + $product->price) * 0.19) ?>
                @endif


                @if ($product->descuento > 0)
                <?php $total += round(((($product->price * $product->utility) + $product->price) * 1.19) - (((($product->price * $product->utility) + $product->price) * 1.19) * $product->descuento)) ?>
                @else
                <?php $total += round((($product->price * $product->utility) + $product->price) * 1.19) ?>
                @endif
                
                
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<table>
    <tbody>
        
        <tr>
            <th style="border: 0px;" width="600px">NETO</th>
            <th style="border: 0px;">${{ number_format($neto,0,',','.') }}</th>
        </tr>

        <tr>
            <th style="border: 0px;" width="600px">IVA</th>
            <th style="border: 0px;">${{ number_format($iva,0,',','.') }}</th>
        </tr>


        <tr>
            <th style="border: 0px;" width="600px">TOTAL</th>
            <th style="border: 0px;">${{ number_format($total,0,',','.') }}</th>
        </tr>
        
       
    </tbody>
</table>





@endsection
