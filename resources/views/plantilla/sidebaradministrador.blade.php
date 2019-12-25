
<div class="sidebar">
<div class="page-wrapper legacy-theme toggled">

<!-- <a id="toggle-sidebar" class="btn btn-sm btn-dark " href="#">
    <i class="icon-menu"></i>
</a> -->
<nav id="sidebar" class="sidebar-wrapper sidebar-nav">

    <div class="sidebar-content ">
        <div class="sidebar-brand">
            <!-- <a href="#">Software OYM</a> -->
            <!-- <button id="toggle-sidebar" class="navbar-toggler sidebar-toggler d-md-down-none" type="button"> -->
            <!-- <img src="img\Publiservicios.png" class="card-img-left" alt="Cinque Terre" width="50%" height="50%">  -->
            <h5>Software OYM</h5>
          <!-- <span class="navbar-toggler-icon"></span> -->
        </button>
        </div>
    <div class="sidebar-header">
        <div class="user-pic">
            <img class="img-avatar img-responsive img-rounded" src="img/avatars/6.png"
            alt="User picture">
        </div>
        <div class="user-info">
            <span class="user-name">OzKr
            <strong>{{Auth::user()->usuario}}</strong>
            </span>
            <span class="user-role">Administrator</span>
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
                        <span>TABLAS MAESTRAS</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="menu-text">General</span>                         
                        </a>
                        <div class="sidebar-submenu">
                        <ul>      
                                                      
                            <li @click="menu=61"  >
                                <a href="#"><i class="icon-bag"></i>Áreas</a>                                                                               
                            </li>
                            <li @click="menu=62">
                                <a href="#"><i class="icon-bag"></i>Cargos</a>                                                                               
                            </li>                                
                            <li @click="menu=42" >
                                <a  href="#"><i class="icon-bag"></i>Marcas</a>
                            </li>
                            <li @click="menu=43" >
                                <a  href="#"><i class="icon-bag"></i>Modelos</a>
                            </li> 
                            <li @click="menu=59" >
                                <a  href="#"><i class="icon-bag"></i>Marcas Veh.</a>
                            </li>
                            <li @click="menu=60" >
                                <a  href="#"><i class="icon-bag"></i>Lineas Veh.</a>
                            </li> 
                            <li @click="menu=52" >
                                <a  href="#"><i class="icon-bag"></i>Mercados</a>
                            </li> 
                            <li @click="menu=53" >
                                <a  href="#"><i class="icon-bag"></i>Ciclos</a>
                            </li> 
                            <li @click="menu=55" >
                                <a  href="#"><i class="icon-bag"></i>Oficinas</a>
                            </li> 
                            <li @click="menu=63" >
                                <a  href="#"><i class="icon-bag"></i>Horarios</a>
                            </li>
                            <li @click="menu=37">
                                <a href="#"><i class="icon-bag"></i>Usuarios</a>
                            </li>
                            <li @click="menu=57" >
                                <a  href="#"><i class="icon-bag"></i>Técnicos</a>
                            </li>
                            <li @click="menu=36" >
                                <a  href="#"><i class="icon-bag"></i>Proveedores</a>
                            </li>
                            <li @click="menu=48" >
                                <a  href="#"><i class="icon-user-following"></i>Tp. Material</a>
                            </li>
                            <li @click="menu=49" >
                                <a  href="#"><i class="icon-user-following"></i>Ref. Material</a>
                            </li>
                            <li @click="menu=64" >
                                <a  href="#"><i class="icon-bag"></i>Rol Usuarios</a>
                            </li>
                        </ul>                            
                        </div>                        
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="menu-text">Mantenimiento</span>                         
                        </a>
                        <div class="sidebar-submenu">
                            <ul>

                            <li @click="menu=4" >
                                <a  href="#"><i class="icon-bag"></i>Accesorios</a>
                            </li>
                            <li @click="menu=34" >
                                <a  href="#"><i class="icon-bag"></i>Actividades</a>
                            </li>
                            <li @click="menu=35" >
                                <a  href="#"><i class="icon-bag"></i>Act. x Equipo</a>
                            </li> 
                            <li @click="menu=58" >
                                <a  href="#"><i class="icon-bag"></i>Diámetros</a>
                            </li> 

                            <li @click="menu=13" >
                                <a  href="#"><i class="icon-wallet"></i>Tp. de Equipo</a>
                            </li>
                            <li @click="menu=33" >
                                <a  href="#"><i class="icon-wallet"></i>Ref. Equipo</a>
                            </li>
                            <li @click="menu=1" >
                                <a  href="#"><i class="icon-bag"></i>Tp. de Estaciónes</a>
                            </li>
                            <li @click="menu=2" >
                                <a  href="#"><i class="icon-bag"></i>Estaciones</a>
                            </li>
                            <li @click="menu=12" >
                                <a  href="#"><i class="icon-bag"></i>Etapas</a>
                            </li>
                            <li @click="menu=31" >
                                <a  href="#"><i class="icon-bag"></i>Insumos</a>
                            </li>
                            <li @click="menu=32" >
                                <a  href="#"><i class="icon-bag"></i>Insumos x Equipos</a>
                            </li>  

                            <!-- <li @click="menu=6" >
                                <a  href="#"><i class="icon-bag"></i>Medidores</a>
                            </li> -->
                            <li @click="menu=68" >
                                <a  href="#"><i class="icon-bag"></i>Novedades</a>
                            </li>
                            <li @click="menu=10" >
                                <a  href="#"><i class="icon-bag"></i> Redes</a>
                            </li>
                            </ul>                            
                        </div>                        
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="menu-text">Operación</span>                         
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li @click="menu=38" >
                                    <a  href="#"><i class="icon-user"></i>Tp. Solicitudes</a>
                                </li>
                                <li @click="menu=39" >
                                    <a  href="#"><i class="icon-user-following"></i>Obj. Solicitudes</a>
                                </li>
                                <li @click="menu=44" >
                                    <a  href="#"><i class="icon-user-following"></i>Cat. Actividades</a>
                                </li>
                                <li @click="menu=45" >
                                    <a  href="#"><i class="icon-user-following"></i>Actividades</a>
                                </li> 
                                <li @click="menu=66" >
                                    <a  href="#"><i class="icon-user-following"></i>Tp. Tramite</a>
                                </li> 
                                <li @click="menu=67" >
                                    <a  href="#"><i class="icon-user-following"></i>Detalle Causal</a>
                                </li> 
                            </ul>                            
                        </div>                        
                    </li>
                    <li class="header-menu">
                        <span>MANTENIMIENTO</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-chart-line"></i>
                            <span class="menu-text">Gestionar Fichas</span>
                        </a>                                        
                        <div class="sidebar-submenu">
                            <ul>
                                <li @click="menu=5" >
                                    <a  href="#"><i class="icon-basket-loaded"></i>Estaciones</a>
                                </li>
                                <li @click="menu=3" >
                                    <a  href="#"><i class="icon-wallet"></i>E. Estación</a>
                                </li>
                                <li @click="menu=41" >
                                    <a  href="#"><i class="icon-basket-loaded"></i> E. de Cómputo</a>
                                </li>
                                <li @click="menu=6" >
                                    <a  href="#"><i class="icon-bag"></i>Vehículos</a>
                                </li>
                                <li @click="menu=9" >
                                    <a  href="#"><i class="icon-notebook"></i>Redes</a>
                                </li>
                                <li @click="menu=11" >
                                    <a  href="#"><i class="icon-notebook"></i>Pasos Especiales</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span class="menu-text">Programar  Mantenimiento</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>                                    
                                <li @click="menu=20" >
                                    <a  href="#"><i class="icon-basket-loaded"></i>Estaciones</a>
                                </li>
                                <li @click="menu=54" >
                                    <a  href="#"><i class="icon-basket-loaded"></i> E. de Cómputo</a>
                                </li>
                                <!-- <li @click="menu=41" >
                                    <a  href="#"><i class="icon-basket-loaded"></i> E. de Estación</a>
                                </li>                                  -->
                                <li @click="menu=69" >
                                    <a  href="#"><i class="icon-bag"></i>Vehículos</a>
                                </li>
                                <li @click="menu=70" >
                                    <a  href="#"><i class="icon-notebook"></i>Redes</a>
                                </li>
                                <li @click="menu=71" >
                                    <a  href="#"><i class="icon-notebook"></i>Pasos Especiales</a>
                                </li>
                            </ul>
                        </div>
                    </li> 
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span class="menu-text">Ejecución  Mantenimiento</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>                                    
                                <li @click="menu=20" >
                                    <a  href="#"><i class="icon-basket-loaded"></i>Ejecución</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="header-menu">
                        <span>OPERACIÓN</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span class="menu-text">Act. de Operación</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                            <li @click="menu=40" >
                                <a  href="#"><i class="icon-user-following"></i>Solicitud</a>
                            </li>
                            </ul>
                        </div>
                        <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span class="menu-text">Act. de Asignación</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                            <li @click="menu=65" >
                                <a  href="#"><i class="icon-user-following"></i>Asignación</a>
                            </li>
                            </ul>
                        </div>
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
                    </li>
                        <li class="header-menu">
                            <span></span>
                         </li>
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

