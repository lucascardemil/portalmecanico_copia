<?php $__env->startSection('content'); ?>


<table>
    <tbody>
        
            <tr>
                <td colspan="2" style="border: 0px; padding-bottom: 10px;"><b><?php echo e($clients[0]->client_razonSocial); ?></b></td>
            </tr>
            

            <tr>
                <td style="border: 0px;" >Direccion</td>
                <td style="border: 0px;" ><?php echo e($clients[0]->client_address); ?></td>
            </tr>

            <tr>
                <td style="border: 0px;" >Telefono</td>
                
                <td style="border: 0px;" ><?php echo e($clients[0]->client_phone); ?></td>
            </tr>

            <tr>
                <td style="border: 0px;" >Fecha</td>
                <td style="border: 0px;" ><?php echo e($clients[0]->sale_updated_at); ?></td>
            </tr>
            
            <tr>
                <td style="border: 0px;" >Empleado</td>
                <td style="border: 0px;"><?php echo e($clients[0]->user_name); ?></td>
            </tr>
        
    </tbody>
</table>
<hr>

<table>
    <tbody>
        <?php $neto = 0; ?>
        <?php $iva = 0; ?>
        <?php $total = 0; ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="border: 0px;" colspan="2"><?php echo e($product->name); ?></td>
            </tr>
            
            <tr>
                <?php if($product->descuento > 0): ?>
                <td style="border: 0px;" width="600px"><?php echo e($product->quantity); ?> X $<?php echo e(round((($product->price * $product->utility) + $product->price) - ((($product->price * $product->utility) + $product->price) * $product->descuento))); ?></td>
                <?php else: ?>
                <td style="border: 0px;" width="600px"><?php echo e($product->quantity); ?> X $<?php echo e(round(($product->price * $product->utility) + $product->price)); ?></td>
                <?php endif; ?>
                <?php if($product->descuento > 0): ?>
                <td style="border: 0px;">$<?php echo e(round(((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) - (((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity)) * $product->descuento))); ?></td>
                <?php else: ?>
                <td style="border: 0px;">$<?php echo e(round((($product->price * $product->quantity) * $product->utility) + ($product->price * $product->quantity))); ?></td>
                <?php endif; ?>

                <?php if($product->descuento > 0): ?>
                <?php $neto += round((($product->price * $product->utility) + $product->price) - ((($product->price * $product->utility) + $product->price) * $product->descuento)) ?>
                <?php else: ?>
                <?php $neto += round(($product->price * $product->utility) + $product->price) ?>
                <?php endif; ?>

                <?php if($product->descuento > 0): ?>
                <?php $iva += round(((($product->price * $product->utility) + $product->price) * 0.19) - (((($product->price * $product->utility) + $product->price) * 0.19) * $product->descuento)) ?>
                <?php else: ?>
                <?php $iva += round((($product->price * $product->utility) + $product->price) * 0.19) ?>
                <?php endif; ?>


                <?php if($product->descuento > 0): ?>
                <?php $total += round(((($product->price * $product->utility) + $product->price) * 1.19) - (((($product->price * $product->utility) + $product->price) * 1.19) * $product->descuento)) ?>
                <?php else: ?>
                <?php $total += round((($product->price * $product->utility) + $product->price) * 1.19) ?>
                <?php endif; ?>
                
                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<hr>

<table>
    <tbody>
        
        <tr>
            <th style="border: 0px;" width="600px">NETO</th>
            <th style="border: 0px;">$<?php echo e(number_format($neto,0,',','.')); ?></th>
        </tr>

        <tr>
            <th style="border: 0px;" width="600px">IVA</th>
            <th style="border: 0px;">$<?php echo e(number_format($iva,0,',','.')); ?></th>
        </tr>


        <tr>
            <th style="border: 0px;" width="600px">TOTAL</th>
            <th style="border: 0px;">$<?php echo e(number_format($total,0,',','.')); ?></th>
        </tr>
        
       
    </tbody>
</table>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutcajaZ', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/pdf/cierre-cajaz.blade.php ENDPATH**/ ?>