@extends('layoutshipping')

@section('content')
    <div style="font-size: 9px; padding-bottom: 10px">
        <div class="text-center">
            <b>COMERCIAL SUPRA E.I.R.L</b> 
        </div>
        <div class="text-center">
            <small>Repuestos Automotrices, Repuestos Maquinarias, Importaciones</small>    
        </div>
        <div class="text-center">
            <small>76.515.046-9</small>    
        </div>
    </div>
    <table>   
        <tbody>
            @foreach($shippings as $shipping)
                <tr>
                    <th>Nombre:</th>    
                    <td>{{ $shipping->nombre }}</td>
                </tr>
                <tr>
                    <th>RUT:</th> 
                    <td>{{ $shipping->rut }}</td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td>{{ $shipping->telefono }}</td>
                </tr>
                <tr>
                    <th>Ciudad:</th>
                    <td>{{ $shipping->ciudad }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{ $shipping->direccion }}</td>
                </tr>
                <tr>
                    <th>Sucursal:</th>
                    <td>{{ $shipping->sucursal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="font-size: 9px;">
        <div class="text-center">
            <small>Alvaro Perez</small> 
        </div>
        <div class="text-center">
            <small>Contacto: +56 9 8948 3379</small> 
        </div>
    </div>
@endsection


