@extends('layout')

@section('content')

    <table class="table table-bordered">
        <tbody>

            <tr style="border-spacing: 15px;!important;">
                <td COLSPAN="2" class="text-center"
                    style="border-top-color:white!important;
                    border-left-color:white!important;
                    border-right-color:white!important;">
                    <img width="150" height="50"
                        src="{{ $user->logo }}">
                </td>
                <td COLSPAN="8" class="text-center"
                    style="border-top-color:white!important;
                    border-left-color:white!important;
                    paddding-top:10px;">
                    <span style="font-size:14px">COMERCIAL SUPRA E.I.R.L</span>
                    <br>
                    <span>Repuestos Automotrices, Repuestos Maquinarias, Importaciones</span>
                    <br>
                    <br>
                </td>
                <td class="text-center" COLSPAN="2">
                    <span style="font-size:16px">RUT: 76.515.046-9</span>
                    <br>
                    <span style="font-size:16px">COTIZACIÓN</span>
                    <br>
                    <span style="font-size:16px">{{ $quotation->id }}</span>
                    <br>
                    <span>FECHA: {{ $quotation->created_at->format('d/m/Y') }}</span>
                </td>
            </tr>

            <!--<tr>
                <td class="text-center" COLSPAN="6" style="padding-right:5px">
                    <span style="font-size:18px">Cotización N°{{ $quotation->id }}</span>
                    <span style="font-size:18px;float:right">{{ $quotation->created_at }}</span>
                </td>
            </tr>-->

            <tr>
                <td COLSPAN="12"
                    style="font-size:14px;padding:10px!important;border-radius:10px">
                    <span>Sr: </span> <b><span>{{ $quotation->client_text }}</span></b>
                    <br>
                    <span>Vehículo: </span> <b><span>{{ $quotation->vehicle }}</span></b>
                </td>
            </tr>

            <!--<tr>
                <td COLSPAN="12"
                    style="font-size:14px;padding:10px!important;border-radius:10px">
                    <span>Sr: </span> <b><span>{{ $client->name }}</span></b>
                    <br>
                    <span>Empresa: </span> <b><span>{{ $client->razonSocial }}</span></b>
                    <br>
                    <span>Rut: </span> <b><span>{{ $client->rut }}</span></b>
                    <br>
                    <span>Dirección: </span> <b><span>{{ $client->address }}</span></b>
                    <br>
                    <span>Ciudad: </span> <b><span>{{ $client->comuna }}</span></b>
                    <br>
                    <span>E-mail: </span> <b><span>{{ $client->email }}</span></b>
                    <br>
                    <span>Teléfono: </span> <b><span>{{ $client->phone }}</span></b>
                </td>
            </tr>-->

            <tr>
                <td class="text-center" COLSPAN="12" style="padding-right:5px">
                    <b>
                        <span style="font-size:16px">
                        Tenemos el agrado de cotizar a ustedes, lo siguiente:
                        </span>
                    </b>
                </td>
            </tr>

            <tr>
                <td class="text-center" COLSPAN="1">
                    Cant
                </td>
                <td class="text-center" COLSPAN="7">
                    Descripción
                </td>
                <td class="text-center" COLSPAN="2">
                    Plazo Entrega
                </td>
                <td class="text-center" COLSPAN="1">
                    Valor Unitario
                </td>
                <td class="text-center" COLSPAN="1">
                    Valor Total
                </td>
            </tr>

            <?php $contador = 0 ?>
            <?php $totalServicio = 0; ?>
            @foreach($products as $detail)
                <tr>

                        <td class="text-center" COLSPAN="1">{{ $detail->quantity }}</td>
                        <td class="text-center" COLSPAN="7">{{ $detail->product }}</td>
                        <td COLSPAN="2">{{ $detail->days }}</td>
                        <td COLSPAN="1">$ {{ round($detail->total / $detail->quantity * 1.19, -1) }}</td>
                        <td COLSPAN="1">$ {{ round($detail->total * 1.19, -1) }}</td>
                        <?php $totalServicio += round($detail->total * 1.19, -1) ?>
                        <?php $contador = $contador + 1 ?>

                </tr>
            @endforeach


            @for($i = $contador; $i < 9; $i++ )
                <tr style="color:white">
                    <td COLSPAN="1">-</td>
                    <td COLSPAN="7">-</td>
                    <td COLSPAN="2">-</td>
                    <td COLSPAN="1">-</td>
                    <td COLSPAN="1">-</td>
                </tr>
            @endfor


            <tr>
                <td COLSPAN="12">
                    <b>
                        <span style="font-size:16px">
                        Observaciones
                        </span>
                    </b>
                </td>
            </tr>

            <tr>
                <td class="text-center" COLSPAN="8" ROWSPAN="3"
                    style="padding-top:10px!important">
                    <span style="font-size:14px">
                        Condiciones de Pago: {{ $quotation->payment }}
                    </span>
                    <br>
                    <br>
                    <span style="font-size:14px">
                        Validez cotización: 5 días
                    </span>
                </td>
                <td class="text-center" COLSPAN="2" style="border:none;">
                    <span style="font-size:12px">
                        Total
                    </span>
                </td>
                <td class="text-center" COLSPAN="2">
                    <span style="font-size:12px">
                        $ {{ round($totalServicio, -1) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td class="text-center" COLSPAN="12" style="border:none;background:black;color:white">
                    <span style="font-size:14px">
                        Repuestos, lubricantes y accesorios para todo tipo de vehículos - Servicio de encargo - Importaciones
                    </span>
                </td>
            </tr>

        </tbody>
    </table>

@endsection

<style>
    table{
        border-collapse: collapse;
        margin-bottom: 0px;
        margin-top: 0px;
    }
    tr, td{
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }
</style>
