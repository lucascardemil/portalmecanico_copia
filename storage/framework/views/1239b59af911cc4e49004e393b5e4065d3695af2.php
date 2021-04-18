<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>Envio N°<?php echo e($shipping->id); ?></title>

        <style>
            @page  { margin: 10px 20px 10px 20px;  }
            table{
                width: 100%;
                font-size: 9px;
            }
            th, td {
                padding: 0 0 15px 0;
            }  
        </style>

    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?>         
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/layoutshipping.blade.php ENDPATH**/ ?>