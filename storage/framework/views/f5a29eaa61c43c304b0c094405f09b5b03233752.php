<?php $__env->startSection('content'); ?>

    <!-- <table class="table" style="border:none;">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td style="padding-top:25px;border:none;">
                    <img width="220" height="100"
                     src="http://comercialsupra.cl/wp-content/uploads/2019/05/logosupra-copia-2.jpg">
                </td>
                <td class="text-center"  style="padding-top:40px;border:none;">
                    <span style="font-size:24px">Recibo N°<?php echo e($sales->id); ?></span>
                </td>
            </tr>
        </tbody>
    </table> -->

    <table class="table table-bordered">
        <thead>
            <tr>
          
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalServicio = 0; ?>
         
            <?php $__currentLoopData = $product_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                
                <td><?php echo e($products->name); ?></td>
                <td width="150px"><?php echo e($product_sale->quantity); ?></td>
                <td width="150px">$<?php echo e(number_format($product_sale->price, 0,',','.')); ?></td>
                <?php $totalServicio += round(((floatval($product_sale->price * $product_sale->quantity)) * floatval($product_sale->utility)) + floatval($product_sale->price * $product_sale->quantity)) ?>
                
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <table class="table">
        
        <tbody>
            <tr>
                
                <td style="border-top: 0px solid #dee2e6">NETO</td>
                <td style="border-top: 0px solid #dee2e6" width="150px"></td>
                <td style="border-top: 0px solid #dee2e6" width="150px">$<?php echo e(number_format($totalServicio,0,',','.')); ?></td>
            </tr>
            <tr>
                
                <td>IVA</td>
                <td width="150px"></td>
                <td width="150px">$<?php echo e(number_format($totalServicio * 0.19,0,',','.')); ?></td>
            </tr>
            <tr>
         
                <th>TOTAL</th>
                <td width="150px"></td>
                <th width="150px">$<?php echo e(number_format($totalServicio * 1.19,0,',','.')); ?></th>
            </tr>
            </tbody>
    </table>


    <!-- <table class="table table-bordered">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td class="text-left">
                    <div style="font-size:16px">
                       Correo: comercialsupra4@gmail.com
                    </div>
                    <div style="font-size:16px">
                       Whatsapp: +56 9 8948 3379
                    </div>
                </td>
            </tr>
        </tbody>
    </table> -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutsale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/pdf/sales-recibo.blade.php ENDPATH**/ ?>