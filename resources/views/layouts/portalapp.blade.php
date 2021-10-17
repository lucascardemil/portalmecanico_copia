<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PortalApp') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-principal.css') }}" rel="stylesheet">
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
     
</head>

<body id="page-top" class="sidebar-toggled">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="{{ route('home') }}">PortalApp</a>

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
            @guest
            
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('perfil') }}">
                        <span class="iconify" data-icon="mdi:account" data-inline="false"></span> {{ __('Mi Perfil') }}
                    </a>

                    <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        <span class="iconify" data-icon="mdi:logout" data-inline="false"></span> {{ __('Cerrar Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout', ['url' => Auth::user()->url  ]) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>

    </nav>

    <div id="wrapper" style="background-image: url('img/background.jpg')">

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

            @can('clients')
            <li id="clientes" class="nav-item">
                <a class="nav-link" href="{{ route('admin-clientes') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Empresas / Proveedores</span></a>
            </li>
            @endcan

            @can('products')
            <li id="productos" class="nav-item">
                <a class="nav-link" href="{{ route('admin-productos') }}">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Productos</span></a>
            </li>
            @endcan

            @can('codes')
            <li id="codigos" class="nav-item">
                <a class="nav-link" href="{{ route('admin-codigos') }}">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Códigos</span></a>
            </li>
            @endcan

            @can('stocks')
            <li id="inventario" class="nav-item">
                <a class="nav-link" href="{{ route('admin-inventario') }}">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Inventario</span></a>
            </li>
            @endcan

            @can('utility')
            <li id="utilidad" class="nav-item">
                <a class="nav-link" href="{{ route('admin-utilidad') }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Formas de Pagos</span></a>
            </li>
            @endcan

            @can('vehicles')
            <li id="vehiculos" class="nav-item">
                <a class="nav-link" href="{{ route('admin-vehiculos') }}">
                    <i class="fas fa-car"></i>
                    <span>Registro Vehículos</span></a>
            </li>
            @endcan

            @can('mechanic-vehicles')
            <li id="vehiculos-m" class="nav-item">
                <a class="nav-link" href="{{ route('admin-vehiculosM') }}">
                    <i class="fas fa-car"></i>
                    <span>Registro Vehículos (Mecánico)</span></a>
            </li>
            @endcan

            @can('brands')
            <li id="marcas" class="nav-item">
                <a class="nav-link" href="{{ route('admin-marca-vehiculos') }}">
                    <i class="fas fa-car"></i>
                    <span>Marcas y Modelos de Vehículos</span></a>
            </li>
            @endcan

            <!-- @can('models')
                <li id="modelos" class="nav-item">
                    <a class="nav-link" href="{{ route('admin-modelo-vehiculos') }}">
                        <i class="fas fa-car"></i>
                    <span>Modelos de Vehículos</span></a>
                </li>
                @endcan -->

            @can('notes')
            <li id="notas" class="nav-item">
                <a class="nav-link" href="{{ route('admin-notas') }}">
                    <i class="fas fa-file"></i>
                    <span>Notas</span></a>
            </li>
            @endcan

            @can('sales')
            <li id="ventas" class="nav-item">
                <a class="nav-link" href="{{ route('admin-ventas') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Ventas</span>
                </a>
            </li>
            @endcan

            @can('simple-quotations')
            <li id="cotizaciones" class="nav-item">
                <a class="nav-link" href="{{ route('admin-cotizacion-express') }}">
                    <i class="fas fa-file-signature"></i>
                    <span>Cotizaciones Express</span></a>
            </li>
            @endcan
            
            @can('quotations')
            <li id="cotizaciones" class="nav-item">
                <a class="nav-link" href="{{ route('admin-cotizaciones-formales') }}">
                    <i class="fas fa-file-signature"></i>
                    <span>Cotizaciones</span></a>
            </li>
            @endcan

            

            @can('bills')
            <li id="bills" class="nav-item">
                <a class="nav-link" href="{{ route('admin-boleta') }}">
                    <i class="fas fa-file-signature"></i>
                    <span>Boletas</span></a>
            </li>
            @endcan

            @can('imports')
            <li id="imports" class="nav-item">
                <a class="nav-link" href="{{ route('admin-importaciones') }}">
                    <i class="fas fa-file-signature"></i>
                    <span>Importaciones</span></a>
            </li>
            @endcan

            @can('users')
            <li id="users" class="nav-item">
                <a class="nav-link" href="{{ route('admin-usuarios') }}">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span></a>
            </li>
            @endcan

            @can('mechanic-users')
            <li id="mechanic-users" class="nav-item">
                <a class="nav-link" href="{{ route('admin-usuariosM') }}">
                    <i class="fas fa-users"></i>
                    <span>Usuarios (mecánico)</span></a>
            </li>
            @endcan

            @can('roles')
            <li id="roles" class="nav-item">
                <a class="nav-link" href="{{ route('admin-roles') }}">
                    <i class="fas fa-cogs"></i>
                    <span>Roles de Usuario</span></a>
            </li>
            @endcan


        </ul>


        <div id="content-wrapper">
            <div id="container-fluid">
                @yield('content')
            </div>
        </div>

    </div>

    <!--<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/app-principal.js') }}"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/vue2-filters/dist/vue2-filters.min.js"></script>-->
    
    
</body>

</html>