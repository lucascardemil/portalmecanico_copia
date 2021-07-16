<?php $__env->startSection('content'); ?>

    <h5></h5>
    <table class="table">
        
        <tbody>
            <?php $totalServicio = 0; ?>
            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Recibo</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" ><?php echo e($sales->id); ?></td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Direccion</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" ><?php echo e($client->address); ?></td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Telefono</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" ><?php echo e($client->phone); ?></td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px; border-top: 0px;" >Fecha</td>
                <td style="border-bottom: 0px; border-top: 0px;" width="150px"></td>
                <td style="border-bottom: 0px; border-top: 0px;" ><?php echo e($sales->updated_at); ?></td>
            </tr>
            
            <tr>
                <td colspan="" style="border-bottom: 0px" >Empleado</td>
                <td style="border-bottom: 0px" width="150px"></td>
                <td style="border-bottom: 0px" width="150px"><?php echo e($user->name); ?></td>
            </tr>

            <tr>
                <td colspan="" style="border-bottom: 0px" >Cliente</td>
                <td style="border-bottom: 0px" width="150px"></td>
                <td style="border-bottom: 0px" width="150px"><?php echo e($client->name); ?></td>
            </tr>
         
            <?php $__currentLoopData = $product_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="3"><?php echo e($products->name); ?></td>
            </tr>
            <tr>
                <td style="border-top: 0px">
                    <ul>
                        <li><?php echo e($product_sale->quantity); ?> X $<?php echo e(number_format($product_sale->price, 0,',','.')); ?></li>
                    </ul>
                </td>
                <td style="border-top: 0px" width="150px"></td>
                <td style="border-top: 0px" width="150px">$<?php echo e(number_format($product_sale->price, 0,',','.')); ?></td>
                <?php $totalServicio += round(((floatval($product_sale->price * $product_sale->quantity)) * floatval($product_sale->utility)) + floatval($product_sale->price * $product_sale->quantity)) ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <table class="table">
        
        <tbody>
            <tr>
                
                <th>NETO</th>
                <td width="150px"></td>
                <th width="150px">$<?php echo e(number_format($totalServicio,0,',','.')); ?></th>
            </tr>
            <tr>
                
                <th style="border-top: 0px">IVA</th>
                <td style="border-top: 0px"  width="150px"></td>
                <th style="border-top: 0px" width="150px">$<?php echo e(number_format($totalServicio * 0.19,0,',','.')); ?></th>
            </tr>
            <tr>
         
                <th style="border-top: 0px">TOTAL</th>
                <td style="border-top: 0px" width="150px"></td>
                <th style="border-top: 0px" width="150px">$<?php echo e(number_format($totalServicio * 1.19,0,',','.')); ?></th>
            </tr>
            </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutsale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/pdf/sales-recibo.blade.php ENDPATH**/ ?>