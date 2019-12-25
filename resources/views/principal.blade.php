    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistema de Operacion y Mantenimiento">
        <meta name="author" content="www.publiservicios.com">
        <meta name="keyword" content="Sistema de Operacion y Mantenimiento Laravel Vue Js">
        <link rel="shortcut icon" href="img/favicon.png">
        <title>Sistema de Operacion y Mantenimiento - OzKr</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Icons -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
        <!-- <link rel="stylesheet" href="../node_modules/material-design-icons-iconfont/dist/material-design-icons.css"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        > 
        <link rel="stylesheet" href="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
        <link href="css/plantilla.css" rel="stylesheet">
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
    <header class="app-header navbar">
       <button   class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button id="close-sidebar" class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <button @click="menu=57"class="" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Escritorio</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Configuraciones</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Ingresos
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> Ventas
                        <span class="badge badge-danger">2</span>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.png" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">{{Auth::user()->nom}} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-user"></i> Perfil</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul> 
    </header>


        <div class="app-body">            
            @if(Auth::check())
                @if (Auth::user()->idrol == 1)  
                                  
                    @include('plantilla.sidebaradministrador')
                @elseif (Auth::user()->idrol == 2)
                    @include('plantilla.sidebarTecnico')
                @elseif (Auth::user()->idrol == 3)
                    @include('plantilla.sidebarSupervisor')
                @else

                @endif

            @endif
            <!-- Contenido Principal -->
            @yield('contenido')
            <!-- /Fin del contenido principal -->
            </div>
       
        </div>
        </div>   
        <footer class="app-footer">
            <span><a href="http://www.codesinfo.com/">OzKr Web</a> &copy; 2019</span>
            <span class="ml-auto">Desarrollado por <a href="http://www.codesinfo.com/">OzKr</a></span>
        </footer>
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
       >
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
       >
    </script> -->
    <script src="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/plantilla.js"></script>

    </body>
    <script language="javascript">
   
jQuery(function ($) {

// Dropdown menu
$(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
    } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
    }

});

//toggle sidebar
$("#toggle-sidebar").click(function () {
    $(".page-wrapper").toggleClass("toggled");
});
//Pin sidebar
$("#pin-sidebar").click(function () {
    if ($(".page-wrapper").hasClass("pinned")) {
        // unpin sidebar when hovered
        $(".page-wrapper").removeClass("pinned");
        $("#sidebar").unbind( "hover");
    } else {
        $(".page-wrapper").addClass("pinned");
        $("#sidebar").hover(
            function () {
                console.log("mouseenter");
                $(".page-wrapper").addClass("sidebar-hovered");
            },
            function () {
                console.log("mouseout");
                $(".page-wrapper").removeClass("sidebar-hovered");
            }
        )

    }
});


//toggle sidebar overlay
$("#overlay").click(function () {
    $(".page-wrapper").toggleClass("toggled");
});

//switch between themes 
var themes = "default-theme legacy-theme chiller-theme ice-theme cool-theme light-theme";
$('[data-theme]').click(function () {
    $('[data-theme]').removeClass("selected");
    $(this).addClass("selected");
    $('.page-wrapper').removeClass(themes);
    $('.page-wrapper').addClass($(this).attr('data-theme'));
});

// switch between background images
var bgs = "bg1 bg2 bg3 bg4";
$('[data-bg]').click(function () {
    $('[data-bg]').removeClass("selected");
    $(this).addClass("selected");
    $('.page-wrapper').removeClass(bgs);
    $('.page-wrapper').addClass($(this).attr('data-bg'));
});

// toggle background image
$("#toggle-bg").change(function (e) {
    e.preventDefault();
    $('.page-wrapper').toggleClass("sidebar-bg");
});

// toggle border radius
$("#toggle-border-radius").change(function (e) {
    e.preventDefault();
    $('.page-wrapper').toggleClass("boder-radius-on");
});

//custom scroll bar is only used on desktop
if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $(".sidebar-content").mCustomScrollbar({
        axis: "y",
        autoHideScrollbar: true,
        scrollInertia: 300
    });
    $(".sidebar-content").addClass("desktop");

}
});
    </script>
    </html>