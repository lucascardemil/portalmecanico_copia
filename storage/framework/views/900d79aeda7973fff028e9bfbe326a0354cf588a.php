<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <?php if(isset($quotation->id)): ?>
        <title>Cotizacion N°<?php echo e($quotation->id); ?></title>
        <?php else: ?>
        <title>Envio N°<?php echo e($shipping->id); ?></title>
        <style>
            @page  { margin: 10px 5px 10px 5px;  }

            
            
            body {
            
               background-color: orange;
            }

            table{
                width: 100%;
                font-size: 9px;
                border: 1px solid black;
            }
            th, td {
  padding: 0 0 15px 0;
}  
        </style>
        <?php endif; ?>
    </head>
    <body>
        
                	<?php echo $__env->yieldContent('content'); ?>
                
    </body>
</html>

<?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/layout.blade.php ENDPATH**/ ?>