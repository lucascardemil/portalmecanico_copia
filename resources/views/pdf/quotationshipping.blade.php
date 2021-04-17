@extends('layoutshipping')

@section('content')

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

@endsection


