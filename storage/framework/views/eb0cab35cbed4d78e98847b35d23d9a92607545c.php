<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Dólar</th>
        <th>Fecha</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($import->name); ?></td>
            <td><?php echo e($import->dolar); ?></td>
            <td><?php echo e($import->created_at); ?></td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th>Producto</th>
        <th>Detalle</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>% Imp Usa</th>
        <th>Seguro</th>
        <th>Ad Valorem</th>
        <th>Adicional</th>
        <th>Embarque</th>
        <th>Fee</th>
        <th>Flete Usa</th>
        <th>BankUsa</th>
        <th>BankChile</th>
        <th>Transferencia</th>
        <th>Otro</th>
        <th>Aduana 1</th>
        <th>Aduana 2</th>
        <th>Manipuleo</th>
        <th>Bodega</th>
        <th>Guia</th>
        <th>Retiro</th>
        <th>Flete Chile</th>
        <th>% </th>
        <th>Internacional</th>
        <th>Nacional</th>
        <th>Costo Total</th>
        <th>Valor Unitario</th>
        <th>Valor Total</th>
        <th>Valor Chile</th>
        <th>Utilidad</th>
    </tr>
    </thead>
    <tbody>
    <?php $totalPorcentaje = 0 ?>
    <?php $totalInternacional = 0 ?>
    <?php $totalNacional = 0 ?>
    <?php $totalCosto = 0 ?>
    <?php $total = 0 ?>
    <?php $totalUtilidad = 0 ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($product->product); ?></td>
            <td><?php echo e($product->detail); ?></td>
            <td><?php echo e($product->price_dolar); ?></td>
            <td><?php echo e($product->quantity); ?></td>
            <td><?php echo e($product->usa * 100); ?></td>
            <td><?php echo e($product->seguro * 100); ?></td>
            <td><?php echo e($product->valorem); ?></td>
            <td><?php echo e($product->aditional); ?></td>
            <td><?php echo e($product->embarque); ?></td>
            <td><?php echo e($product->fee); ?></td>
            <td><?php echo e($product->fleteUsa); ?></td>
            <td><?php echo e($product->bankusa); ?></td>
            <td><?php echo e($product->bankchile); ?></td>
            <td><?php echo e($product->transferencia); ?></td>
            <td><?php echo e($product->otro); ?></td>
            <td><?php echo e($product->aduana1); ?></td>
            <td><?php echo e($product->aduana2); ?></td>
            <td><?php echo e($product->manipuleo); ?></td>
            <td><?php echo e($product->bodega); ?></td>
            <td><?php echo e($product->guia); ?></td>
            <td><?php echo e($product->retiro); ?></td>
            <td><?php echo e($product->fleteChile); ?></td>
            <td><?php echo e($product->percentage); ?></td>
            <?php $totalPorcentaje += $product->percentage; ?>
            <td><?php echo e($product->internacional); ?></td>
            <?php $totalInternacional += $product->internacional; ?>
            <td><?php echo e($product->nacional); ?></td>
            <?php $totalNacional += $product->nacional; ?>
            <td><?php echo e($product->costTotal); ?></td>
            <?php $totalCosto += $product->costTotal; ?>
            <td><?php echo e($product->total / $product->quantity); ?></td>
            <td><?php echo e($product->total); ?></td>
            <?php $total += $product->total; ?>
            <td><?php echo e($product->valueChile); ?></td>
            <td><?php echo e($product->utility); ?></td>
            <?php $totalUtilidad += $product->utility; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th>Totales</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo $totalPorcentaje; ?></th>
        <th><?php echo $totalInternacional; ?></th>
        <th><?php echo $totalNacional; ?></th>
        <th><?php echo $totalCosto; ?></th>
        <th></th>
        <th><?php echo $total; ?></th>
        <th></th>
        <th><?php echo $totalUtilidad; ?></th>
    </tr>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/excel/importacion.blade.php ENDPATH**/ ?>