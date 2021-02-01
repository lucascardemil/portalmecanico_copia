<?php $__env->startSection('content'); ?>

    <table class="table table-bordered">
        <tbody>

            <tr style="border-spacing: 15px;!important;">
                <td COLSPAN="2" class="text-center"
                    style="border-top-color:white!important;
                    border-left-color:white!important;
                    border-right-color:white!important;">
                    <img width="150" height="50"
                        src="<?php echo e($user->logo); ?>">
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
                    <span style="font-size:16px"><?php echo e($quotation->id); ?></span>
                    <br>
                    <span>FECHA: <?php echo e($quotation->created_at->format('d/m/Y')); ?></span>
                </td>
            </tr>

            <!--<tr>
                <td class="text-center" COLSPAN="6" style="padding-right:5px">
                    <span style="font-size:18px">Cotización N°<?php echo e($quotation->id); ?></span>
                    <span style="font-size:18px;float:right"><?php echo e($quotation->created_at); ?></span>
                </td>
            </tr>-->

            <tr>
                <td COLSPAN="12"
                    style="font-size:14px;padding:10px!important;border-radius:10px">
                    <span>Sr: </span> <b><span><?php echo e($client->name); ?></span></b>
                    <br>
                    <span>Empresa: </span> <b><span><?php echo e($client->razonSocial); ?></span></b>
                    <br>
                    <span>Rut: </span> <b><span><?php echo e($client->rut); ?></span></b>
                    <br>
                    <span>Dirección: </span> <b><span><?php echo e($client->address); ?></span></b>
                    <br>
                    <span>Ciudad: </span> <b><span><?php echo e($client->comuna); ?></span></b>
                    <br>
                    <span>E-mail: </span> <b><span><?php echo e($client->email); ?></span></b>
                    <br>
                    <span>Teléfono: </span> <b><span><?php echo e($client->phone); ?></span></b>
                </td>
                <!--<td COLSPAN="2" style="font-size:13px">
                    <span>Sr: </span> <b><span>Álvaro Pérez</span></b>
                    <br>
                    <span>Empresa: </span> <b><span>Comercial Supra E.I.R.L</span></b>
                    <br>
                    <span>Rut: </span> <b><span>76.515.046-9</span></b>
                    <br>
                    <span>Dirección: </span> <b><span>Rubén Jiménez 601</span></b>
                    <br>
                    <span>Ciudad: </span> <b><span>Coquimbo</span></b>
                    <br>
                    <span>E-mail: </span> <b><span>comercialsupra4@gmail.com</span></b>
                    <br>
                    <span>Teléfono: </span> <b><span>(+569) 89483379</span></b>
                </td>-->
            </tr>

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
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                        <td class="text-center" COLSPAN="1"><?php echo e($detail->quantity); ?></td>
                        <td class="text-center" COLSPAN="7"><?php echo e($detail->product); ?></td>
                        <td COLSPAN="2"><?php echo e($detail->days); ?></td>
                        <td COLSPAN="1">$ <?php echo e(round($detail->total / $detail->quantity, -1)); ?></td>
                        <td COLSPAN="1">$ <?php echo e(round($detail->total, -1)); ?></td>
                        <?php $totalServicio += $detail->total ?>
                        <?php $contador = $contador + 1 ?>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <?php for($i = $contador; $i < 9; $i++ ): ?>
                <tr style="color:white">
                    <td COLSPAN="1">-</td>
                    <td COLSPAN="7">-</td>
                    <td COLSPAN="2">-</td>
                    <td COLSPAN="1">-</td>
                    <td COLSPAN="1">-</td>
                </tr>
            <?php endfor; ?>


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
                        Condiciones de Pago: <?php echo e($quotation->payment); ?>

                    </span>
                    <br>
                    <br>
                    <span style="font-size:14px">
                        Validez cotización: 5 días
                    </span>
                </td>
                <td class="text-center" COLSPAN="2" style="border:none;">
                    <span style="font-size:12px">
                        Neto
                    </span>
                </td>
                <td class="text-center" COLSPAN="2">
                    <span style="font-size:12px">
                        $ <?php echo e(round($totalServicio, -1)); ?>

                    </span>
                </td>
            </tr>

            <tr>
                <td class="text-center" COLSPAN="2" style="border:none;">
                    <span style="font-size:12px">
                        Iva
                    </span>
                </td>
                <td class="text-center" COLSPAN="2">
                    <span style="font-size:12px">
                        $ <?php echo e(round($totalServicio * 0.19, -1)); ?>

                    </span>
                </td>
            </tr>

            <tr>
                <td class="text-center" COLSPAN="2" style="border:none;">
                    <span style="font-size:12px">
                        Total
                    </span>
                </td>
                <td class="text-center" COLSPAN="2">
                    <span style="font-size:12px">
                        $ <?php echo e(round($totalServicio * 1.19, -1)); ?>

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

<?php $__env->stopSection(); ?>

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

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vps/portalmecanico/resources/views/pdf/quotationclient.blade.php ENDPATH**/ ?>