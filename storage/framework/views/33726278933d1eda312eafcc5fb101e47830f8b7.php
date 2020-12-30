<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PortalApp</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
         <link href="<?php echo e(asset('css/app-principal.css')); ?>" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <sesion-component></sesion-component>
        </div>
    </body>
</html>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script src="<?php echo e(asset('js/app-principal.js')); ?>"></script>
<?php /**PATH C:\wamp64\www\portalmecanico_copia\resources\views/sesion.blade.php ENDPATH**/ ?>