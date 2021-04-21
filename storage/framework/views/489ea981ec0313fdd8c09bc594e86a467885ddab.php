<?php $__env->startSection('content'); ?>
    <table>   
        <tbody>
            <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th>ATTE:</th>    
                    <td><?php echo e($shipping->nombre); ?></td>
                </tr>
                <tr>
                    <th>RUT:</th> 
                    <td><?php echo e($shipping->rut); ?></td>
                </tr>
                <tr>
                    <th>CEL:</th>
                    <td><?php echo e($shipping->telefono); ?></td>
                </tr>
                <tr>
                    <th>CIUDAD:</th>
                    <td><?php echo e($shipping->ciudad); ?></td>
                </tr>
                <tr>
                    <th>DIRECCION:</th>
                    <td><?php echo e($shipping->direccion); ?></td>
                </tr>
                <tr>
                    <th>SUCURSAL:</th>
                    <td><?php echo e($shipping->sucursal); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th style="padding-top: 15px;">RTE:</th>    
                    <td style="padding-top: 15px;">COMERCIAL SUPRA E.I.R.L</td>
                </tr>
                <tr>
                    <th>RUT:</th> 
                    <td>76.515.046-9</td>
                </tr>
                <tr>
                    <th>CEL:</th>
                    <td>+56 9 8948 3379</td>
                </tr>
                <tr>
                    <th>DIRECCION:</th>
                    <td>Av. Rubén Jiménez 601, Coquimbo</td>
                </tr>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layoutshipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/pdf/quotationshipping.blade.php ENDPATH**/ ?>