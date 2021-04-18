<?php $__env->startSection('content'); ?>
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
            <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th>Nombre:</th>    
                    <td><?php echo e($shipping->nombre); ?></td>
                </tr>
                <tr>
                    <th>RUT:</th> 
                    <td><?php echo e($shipping->rut); ?></td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td><?php echo e($shipping->telefono); ?></td>
                </tr>
                <tr>
                    <th>Ciudad:</th>
                    <td><?php echo e($shipping->ciudad); ?></td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td><?php echo e($shipping->direccion); ?></td>
                </tr>
                <tr>
                    <th>Sucursal:</th>
                    <td><?php echo e($shipping->sucursal); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layoutshipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/pdf/quotationshipping.blade.php ENDPATH**/ ?>