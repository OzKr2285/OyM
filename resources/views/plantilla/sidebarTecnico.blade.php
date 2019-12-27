
<div class="sidebar">
<div class="page-wrapper legacy-theme toggled">

<!-- <a id="toggle-sidebar" class="btn btn-sm btn-dark " href="#">
    <i class="icon-menu"></i>
</a> -->
<nav id="sidebar" class="sidebar-wrapper sidebar-nav">
    <div class="sidebar-content ">
        <div class="sidebar-brand">
            <a href="#">Software OYM</a>
            <button id="toggle-sidebar" class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        </div>
    <div class="sidebar-header">
        <div class="user-pic">
            <img class="img-avatar img-responsive img-rounded" src="img/avatars/6.png"
            alt="User picture">
        </div>
        <div class="user-info">
            <span class="user-name">{{Auth::user()->nom}}
            </span>
            <span class="user-role">Técnico</span>
            <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
            </span>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li class="sidebar-dropdown ">
                <ul>

                <li class="header-menu">
                    <span>OPERACIÓN</span>
                </li>
                    <li class="sidebar-dropdown">
                    <a href="#">
                            <i class="fa fa-globe"></i>
                            <span class="menu-text">Act. de Ejecución</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>   
                            <li @click="menu=72" >
                                <a  href="#"><i class="icon-user-following"></i>Servicio Técnico </a>
                            </li>      
                            <li @click="menu=50" >
                                <a  href="#"><i class="icon-user"></i>Reclamación</a>
                            </li>
                            <li @click="menu=47 " >
                                <a  href="#"><i class="icon-user-following"></i>Disponibilidad</a>
                            </li>
                            <li @click="menu=50" >
                                <a  href="#"><i class="icon-user"></i>Instalación</a>
                            </li>
                            <li @click="menu=45" >
                                <a  href="#"><i class="icon-user-following"></i> T2</a>
                            </li>
                       
                            </ul>
                        </div>
                        <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span class="menu-text">PQR´S</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                            <li @click="menu=47 " >
                                <a  href="#"><i class="icon-user-following"></i>Disponibilidad</a>
                            </li>
                            <li @click="menu=50" >
                                <a  href="#"><i class="icon-user"></i>Instalaciones</a>
                            </li>
                            <li @click="menu=39" >
                                <a  href="#"><i class="icon-user-following"></i>Ordenes de Servicio </a>
                            </li>
                            </ul>
                        </div>
                    </li>
                        <!-- <li class="header-menu">
                            <span>PQR´S</span>
                         </li> -->
<!--                 
                    <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span class="menu-text">Gestión PQR´S</span>
                            <span class="badge badge-pill badge-primary">Beta</span>
                        </a>
                        
                    </li> -->
                    <!-- <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="menu-text">Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-folder"></i>
                            <span class="menu-text">Examples</span>
                        </a>
                    </li> -->
                
                </ul>
            </div>
    </div>
<div class="sidebar-footer">
  <a href="#">
    <i class="fa fa-bell"></i>
    <span class="badge badge-pill badge-warning notification">3</span>
  </a>
  <a href="#">
    <i class="fa fa-envelope"></i>
    <span class="badge badge-pill badge-success notification">7</span>
  </a>
  <a href="#">
    <i class="fa fa-cog"></i>
    <span class="badge-sonar"></span>
  </a>
  <div>
      
  </div>
  <a href="#">
    <i class="fa fa-power-off"></i>
  </a>
</div>
</nav>

 <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
</div>

