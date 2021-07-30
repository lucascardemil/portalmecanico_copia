<?php $__env->startSection('content'); ?>


<table>
    <tbody>
        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr >
                <td colspan="2" style="border: 0px; padding-bottom: 10px;"><b><?php echo e($client->client_razonSocial); ?></b></td>
            </tr>
            <tr>
                <td style="border: 0px;" >Recibo</td>
                
                <td style="border: 0px;" ><?php echo e($client->sale_id); ?></td>
            </tr>

            <tr>
                <td style="border: 0px;" >Direccion</td>
                <td style="border: 0px;" ><?php echo e($client->client_address); ?></td>
            </tr>

            <tr>
                <td style="border: 0px;" >Telefono</td>
                
                <td style="border: 0px;" ><?php echo e($client->client_phone); ?></td>
            </tr>

            <tr>
                <td style="border: 0px;" >Fecha</td>
                <td style="border: 0px;" ><?php echo e($client->sale_updated_at); ?></td>
            </tr>
            
            <tr>
                <td style="border: 0px;" >Empleado</td>
                <td style="border: 0px;"><?php echo e($client->user_name); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<hr style="margin-bottom: 5px; margin-top: 5px;">

<table>
    <tbody>
        <?php $totalServicio = 0; ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="border: 0px;" colspan="3"><?php echo e($product->name); ?></td>
            </tr>
            
            <tr>
                <td style="border: 0px;"><?php echo e($product->quantity); ?> X $<?php echo e(number_format($product->price, 0,',','.')); ?></td>
                <td style="border: 0px;" width="50px"></td>
                <td style="border: 0px;" width="50px">$<?php echo e(number_format(round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)), 0,',','.')); ?></td>
                <?php $totalServicio += round(((floatval($product->price * $product->quantity)) * floatval($product->utility)) + floatval($product->price * $product->quantity)) ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<hr style="margin-bottom: 5px; margin-top: 5px;">

<table>
    <tbody>
        <tr>
            
            <th style="border: 0px;">NETO</th>
            <td style="border: 0px;" width="50px"></td>
            <th style="border: 0px;" width="50px">$<?php echo e(number_format($totalServicio,0,',','.')); ?></th>
        </tr>
        <tr>
            
            <th style="border: 0px;">IVA</th>
            <td style="border: 0px;" width="50px"></td>
            <th style="border: 0px;" width="50px">$<?php echo e(number_format($totalServicio * 0.19,0,',','.')); ?></th>
        </tr>
        <tr>
        
            <th style="border: 0px;">TOTAL</th>
            <td style="border: 0px;" width="50px"></td>
            <th style="border: 0px;" width="50px">$<?php echo e(number_format($totalServicio * 1.19,0,',','.')); ?></th>
        </tr>
    </tbody>
</table>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutsale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/pdf/sales-recibo.blade.php ENDPATH**/ ?>