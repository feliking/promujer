<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
    @section('title')
    Pro Mujer IFD
    @show
    </title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="{{asset('css/lib/normalize.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/pe-icon-7-stroke.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/toastr.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/lib/print.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/chosen/chosen.min.css') }}">
    

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body class="open">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-home"></i>Dashboard </a>
                    </li>
                    @foreach(Auth::user()->roles as $rol)
                    @if($rol->pivot->role_id == 1)
                    <li class="menu-title">Administrador</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown" title="Administrador">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Administrador</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('user.main') }}">Usuarios</a></li>
                            @if(Auth::user()->id == 1)
                                <li><i class="fa fa-id-badge"></i><a href="{{ route('user.config') }}">Configurar administrador</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($rol->pivot->role_id == 2)
                    <li class="menu-title">Proveedores</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown" title="Proveedores">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Proveedores</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('provider_personals.main') }}">Persona Natural</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ route('provider_company.main') }}">Persona Juridica</a></li>
                        </ul>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <p class="nav-link" href="#"><i class="fa fa-user"></i>{{ Auth::user()->first_name }}</p>
                            <hr>
                            {{-- <a class="nav-link" href="#"><i class="fa fa-cog"></i>Contraseña</a> --}}

                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off" ></i>Cerrar Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>
                                    @yield('title-content')
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content" id="app">
            <div class="animated fadeIn">
                @yield('content')
            </div><!-- .animated -->
        </div><!-- .content -->
        <div class="clearfix"></div>

        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2019 Pro Mujer IFD La Paz - Bolivia
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://feliking.github.io/portafolio/">Feliking</a>
                    </div>
                </div>
            </div>
        </footer>


</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.js') }}"></script>

<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/lib/popper.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.matchHeight.min.js') }}"></script>
<script src="{{ asset('js/lib/toastr.min.js') }}"></script>
<script src="{{ asset('js/lib/print.min.js') }}"></script>
<script>
    
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    
    let token = document.head.querySelector('meta[name="csrf-token"]');
    
    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }
</script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/lib/chosen/chosen.jquery.min.js') }}"></script>

@yield('scripts')
</body>
</html>