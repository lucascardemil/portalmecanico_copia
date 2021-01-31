<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'PortalApp')); ?></title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app-principal.css')); ?>" rel="stylesheet">
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
     
</head>

<body id="page-top" class="sidebar-toggled">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="<?php echo e(route('home')); ?>">PortalApp</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <!--<input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>-->
            </div>
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <!-- Authentication Links -->
            <?php if(auth()->guard()->guest()): ?>
            
            <?php else: ?>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <?php echo e(Auth::user()->name); ?>

                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('perfil')); ?>">
                        <span class="iconify" data-icon="mdi:account" data-inline="false"></span> <?php echo e(__('Mi Perfil')); ?>

                    </a>

                    <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        <span class="iconify" data-icon="mdi:logout" data-inline="false"></span> <?php echo e(__('Cerrar Sesión')); ?>

                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </li>
            <?php endif; ?>
        </ul>

    </nav>

    <div id="wrapper" style="background-image: url('https://www.wallpaperup.com/uploads/wallpapers/2013/09/29/153228/9a4ccb57bae565de8bd9eb6734103946-1000.jpg')">

        <ul class="sidebar navbar-nav toggled">

            <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <h6 class="dropdown-header">Login Screens:</h6>
                        <a class="dropdown-item" href="login.html">Login</a>
                        <a class="dropdown-item" href="register.html">Register</a>
                        <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">Other Pages:</h6>
                        <a class="dropdown-item" href="404.html">404 Page</a>
                        <a class="dropdown-item" href="blank.html">Blank Page</a>
                    </div>
                </li>-->

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients')): ?>
            <li id="clientes" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-clientes')); ?>">
                    <i class="fas fa-users-cog"></i>
                    <span>Empresas / Proveedores</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products')): ?>
            <li id="productos" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-productos')); ?>">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Productos</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('codes')): ?>
            <li id="codigos" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-codigos')); ?>">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Códigos</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stocks')): ?>
            <li id="inventario" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-inventario')); ?>">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Inventario</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicles')): ?>
            <li id="vehiculos" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-vehiculos')); ?>">
                    <i class="fas fa-car"></i>
                    <span>Registro Vehículos</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mechanic-vehicles')): ?>
            <li id="vehiculos-m" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-vehiculosM')); ?>">
                    <i class="fas fa-car"></i>
                    <span>Registro Vehículos (Mecánico)</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands')): ?>
            <li id="marcas" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-marca-vehiculos')); ?>">
                    <i class="fas fa-car"></i>
                    <span>Marcas y Modelos de Vehículos</span></a>
            </li>
            <?php endif; ?>

            <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('models')): ?>
                <li id="modelos" class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin-modelo-vehiculos')); ?>">
                        <i class="fas fa-car"></i>
                    <span>Modelos de Vehículos</span></a>
                </li>
                <?php endif; ?> -->

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notes')): ?>
            <li id="notas" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-notas')); ?>">
                    <i class="fas fa-file"></i>
                    <span>Notas</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales')): ?>
            <li id="ventas" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-ventas')); ?>">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Ventas</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quotations')): ?>
            <li id="cotizaciones" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-cotizaciones-formales')); ?>">
                    <i class="fas fa-file-signature"></i>
                    <span>Cotizaciones</span></a>
            </li>
            <?php endif; ?>

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bills')): ?>
            <li id="bills" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-boleta')); ?>">
                    <i class="fas fa-file-signature"></i>
                    <span>Boletas</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('imports')): ?>
            <li id="imports" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-importaciones')); ?>">
                    <i class="fas fa-file-signature"></i>
                    <span>Importaciones</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users')): ?>
            <li id="users" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-usuarios')); ?>">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mechanic-users')): ?>
            <li id="mechanic-users" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-usuariosM')); ?>">
                    <i class="fas fa-users"></i>
                    <span>Usuarios (mecánico)</span></a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles')): ?>
            <li id="roles" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin-roles')); ?>">
                    <i class="fas fa-cogs"></i>
                    <span>Roles de Usuario</span></a>
            </li>
            <?php endif; ?>


        </ul>


        <div id="content-wrapper">
            <div id="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>

    </div>

    <!--<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>-->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app-principal.js')); ?>"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/vue2-filters/dist/vue2-filters.min.js"></script>-->
</body>

</html><?php /**PATH C:\xampp\htdocs\portalmecanico_copia\resources\views/layouts/portalapp.blade.php ENDPATH**/ ?>