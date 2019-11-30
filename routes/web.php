<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Almacenero']], function () {
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');

    });

    Route::group(['middleware' => ['Vendedor']], function () {
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');        
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta'); 

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'ventaController@store');
        Route::put('/venta/desactivar', 'ventaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'ventaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'ventaController@obtenerDetalles');
    });

    Route::group(['middleware' => ['Administrador']], function () {
        
        Route::get('/actividad', 'ActividadController@index');
        Route::post('/actividad/registrar', 'ActividadController@store');
        Route::put('/actividad/actualizar', 'ActividadController@update');
        Route::post('/actividad/eliminar', 'ActividadController@destroy');

        Route::get('/actividade', 'ActividadEController@index');

        Route::get('/actserv', 'ActServPqrsController@detAct');

        Route::get('/accesorio', 'AccesorioController@index');
        Route::post('/accesorio/registrar', 'AccesorioController@store');
        Route::put('/accesorio/actualizar', 'AccesorioController@update');
        Route::post('/accesorio/eliminar', 'AccesorioController@destroy');

        Route::get('/area', 'AreaController@index');
        Route::post('/area/registrar', 'AreaController@store');
        Route::put('/area/actualizar', 'AreaController@update');
        Route::post('/area/eliminar', 'AreaController@destroy');
        Route::get('/area/selectArea', 'AreaController@selectArea');        

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

        Route::get('/cargo/selectCargo', 'CargoController@selectCargo');

        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
       
        Route::get('/catserv', 'CatServiciosController@index');
        Route::post('/catserv/registrar', 'CatServiciosController@store');
        Route::put('/catserv/actualizar', 'CatServiciosController@update');
        Route::get('/catserv/selectCategoria', 'CatServiciosController@selectCategoria');

        Route::get('/cliente', 'ClienteController@index');
        Route::get('/tecnico', 'ClienteController@index2');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::post('/cliente/registrarT', 'ClienteController@storeT');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

        Route::post('/demo/registrar', 'demoController@store');

        Route::get('/detactequipo', 'DetActEquipoController@index');
        Route::post('/detactequipo/registrar', 'DetActEquipoController@store');
        Route::put('/detactequipo/actualizar', 'DetActEquipoController@update');
        Route::post('/detactequipo/eliminar', 'DetActEquipoController@destroy');
        Route::get('/detactequipo/detact', 'DetActEquipoController@detAct');
        Route::get('/detactequipo/actE', 'DetActEquipoController@actE');
                
        Route::get('/detequipo', 'DetEquipoController@index');        
        Route::post('/detequipo/eliminar', 'DetEquipoController@destroy');
        
        Route::get('/detinsumo', 'DetInsEquipoController@index');
        Route::post('/detinsumo/registrar', 'DetInsEquipoController@store');
        Route::put('/detinsumo/actualizar', 'DetInsEquipoController@update');
        Route::get('/detinsumo/detIns', 'DetInsEquipoController@detIns');
        Route::get('/detinsumo/insumose', 'DetInsEquipoController@InsumosE');
        
        Route::get('/detmercado', 'DetMercadoController@index');
        Route::post('/detmercado/registrar', 'DetMercadoController@store');
        Route::put('/detmercado/actualizar', 'DetMercadoController@update');
        Route::post('/detmercado/eliminar', 'DetMercadoController@destroy');

        Route::get('/detmtoes', 'DetMtoEsController@equiposMto');   
        // Route::get('/detmtoes/get', 'DetMtoEsController@equiposMto');

        Route::get('/diametro', 'DiametroController@index');
        Route::post('/diametro/registrar', 'DiametroController@store');
        Route::put('/diametro/actualizar', 'DiametroController@update');
        Route::post('/diametro/eliminar', 'DiametroController@destroy');
        Route::get('/diametro/selectDiametro', 'DiametroController@selectDiametro');

        Route::get('/conte', 'DetEquipoEstacionController@contE');
        Route::get('/detequipoestacion/estacion', 'DetEquipoEstacionController@indexEstacion');        
        Route::get('/detequipoestacion/ppal', 'DetEquipoEstacionController@indexExEstacion0');
        Route::get('/detequipoestacion/bypass', 'DetEquipoEstacionController@indexExEstacion1');
        Route::get('/detequipoestacion/etapas', 'DetEquipoEstacionController@indexEtapasEs');
        Route::post('/detequipoestacion/registrar', 'DetEquipoEstacionController@store');
        
        Route::get('/diametro/selectDiametro', 'DiametroController@selectDiametro');
        
        Route::get('/dpto/selectDpto', 'DptoController@selectDpto');
        Route::get('/dpto/selectDptoCbx', 'DptoController@selectDptoCbx');
                
        Route::get('/etapa', 'EtapaController@index');
        Route::post('/etapa/registrar', 'EtapaController@store');
        Route::put('/etapa/actualizar', 'EtapaController@update');
        Route::post('/etapa/eliminar', 'EtapaController@destroy');
        Route::get('/etapa/selectEtapa', 'EtapaController@selectEtapa');            
             
        Route::get('/estacion', 'EstacionController@index');       
        Route::post('/estacion/registrar', 'EstacionController@store');
        Route::put('/estacion/actualizar', 'EstacionController@update');
        Route::post('/estacion/eliminar', 'EstacionController@destroy');
        Route::get('/estacion/selectEstacion', 'EstacionController@selectEstacion');
        Route::get('/estacion/selectNomEstacion', 'EstacionController@selectNomEstacion');        
                
        Route::get('/equipo', 'EquiposController@index');
        Route::get('/equipo/computo', 'EquiposController@index2');        
        Route::get('/equipo/exetapa', 'EquiposController@indexExEtapa');
        Route::post('/equipo/registrar', 'EquiposController@store');
        Route::post('/equipo/registrarcomp', 'EquiposController@storeComp');
        Route::put('/equipo/actualizar', 'EquiposController@update');
        Route::post('/equipo/eliminar', 'EquiposController@destroy');

        // Route::get('/ecomputo/exetapa', 'EquipoComputoController@indexExEtapa');
        // Route::post('/ecomputo/registrar', 'EquipoComputoController@store');
        // Route::put('/ecomputo/actualizar', 'EquipoComputoController@update');
        // Route::post('/ecomputo/eliminar', 'EquipoComputoController@destroy');

        Route::get('/fichared', 'FichaRedController@index');
        Route::post('/fichared/registrar', 'FichaRedController@store');
        Route::put('/fichared/actualizar', 'FichaRedController@update');
        Route::post('/fichared/eliminar', 'FichaRedController@destroy');
        
        Route::get('/fichaveh', 'FichaVehController@index');
        Route::post('/fichaveh/registrar', 'FichaVehController@store');
        Route::put('/fichaveh/actualizar', 'FichaVehController@update');
        Route::post('/fichaveh/eliminar', 'FichaVehController@destroy');
        
        Route::get('/horario', 'HorarioController@index');
        Route::post('/horario/registrar', 'HorarioController@store');
        Route::put('/horario/actualizar', 'HorarioController@update');
        Route::post('/horario/eliminar', 'HorarioController@destroy');
        Route::get('/horario/selectHorario', 'HorarioController@selectHorario');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');

        Route::get('/insumo', 'InsumoController@index');
        Route::post('/insumo/registrar', 'InsumoController@store');
        Route::put('/insumo/actualizar', 'InsumoController@update');
        Route::post('/insumo/eliminar', 'InsumoController@destroy');

        Route::get('/insumoe', 'InsumoEController@index');
        
        Route::get('/linea', 'LineaController@index');
        Route::post('/linea/registrar', 'LineaController@store');
        Route::put('/linea/actualizar', 'LineaController@update');
        Route::post('/linea/eliminar', 'LineaController@destroy');
        Route::get('/linea/selectLinea', 'LineaController@selectLinea');                        
      
        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::post('/marca/eliminar', 'MarcaController@destroy');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');
        
        Route::get('/marcaVeh', 'MarcaVehController@index');
        Route::post('/marcaVeh/registrar', 'MarcaVehController@store');
        Route::put('/marcaVeh/actualizar', 'MarcaVehController@update');
        Route::post('/marcaVeh/eliminar', 'MarcaVehController@destroy');
        Route::get('/marcaveh/selectMarca', 'MarcaVehController@selectMarca');
        
        Route::get('/mercado', 'MercadoController@index');
        Route::post('/mercado/registrar', 'MercadoController@store');
        Route::put('/mercado/actualizar', 'MercadoController@update');
        Route::post('/mercado/eliminar', 'MercadoController@destroy');
        Route::get('/mercado/selectMercado', 'MercadoController@selectTpMercado');

        Route::get('/modelo', 'ModeloController@index');
        Route::post('/modelo/registrar', 'ModeloController@store');
        Route::put('/modelo/actualizar', 'ModeloController@update');
        Route::post('/modelo/eliminar', 'ModeloController@destroy');
        Route::get('/modelo/selectModelo', 'ModeloController@selectModelo');
        
        Route::get('/mpio/selectMpio', 'MpioController@selectMpio');
        Route::get('/mpio/getMpios', 'MpioController@getMpios');

        Route::get('/mto', 'MtoEsController@index');
        Route::post('/mto/registrar', 'MtoEsController@store');
        Route::put('/mto/actualizar', 'MtoEsController@update');

        Route::get('/noveh', 'NoVehController@index');
        Route::post('/noveh/registrar', 'NoVehController@store');

        Route::get('/novedad/selectNovedad', 'NovedadController@selectNovedad');

        Route::get('/objpqrs', 'ObjPQRSController@index');
        Route::post('/objpqrs/registrar', 'ObjPQRSController@store');
        Route::put('/objpqrs/actualizar', 'ObjPQRSController@update');
        Route::post('/objpqrs/eliminar', 'ObjPQRSController@destroy');
        Route::get('/objpqrs/selectCat', 'ObjPQRSController@selectObjeto');
        
        Route::post('/persona/registrar', 'UserController@store');
        Route::put('/persona/actualizar', 'UserController@update');
        Route::get('/persona/selectPersona', 'PersonaController@selectPersona');
        Route::get('/persona/selectTecnico', 'PersonaController@selectTecnico');
        Route::get('/persona/getusuario', 'PersonaController@getUsuario');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/getProveedor', 'ProveedorController@getProveedor');
                 
        Route::get('/refequipo', 'RefEquipoController@index');
        Route::post('/refequipo/registrar', 'RefEquipoController@store');
        Route::put('/refequipo/actualizar', 'RefEquipoController@update');
        Route::post('/refequipo/eliminar', 'RefEquipoController@destroy');
        Route::get('/refequipo/selectRefEquipo', 'RefEquipoController@selectRefEquipo');

        Route::get('/refmaterial', 'RefMaterialController@index');
        Route::post('/refmaterial/registrar', 'RefMaterialController@store');
        Route::put('/refmaterial/actualizar', 'RefMaterialController@update');
        Route::post('/refmaterial/eliminar', 'RefMaterialController@destroy');
        Route::get('/refmaterial/getRefM', 'RefMaterialController@getRefM');
        

        Route::get('/red', 'RedController@index');
        Route::post('/red/registrar', 'RedController@store');
        Route::put('/red/actualizar', 'RedController@update');
        Route::post('/red/eliminar', 'RedController@destroy');
        Route::get('/red/selectRed', 'RedController@selectRed');
        
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/servicio', 'ServicioController@index');
        Route::post('/servicio/registrar', 'ServicioController@store');
        Route::put('/servicio/actualizar', 'ServicioController@update');
        Route::post('/servicio/eliminar', 'ServicioController@destroy');
        Route::get('/servicio/getservicio', 'ServicioController@getServicio');
        
        Route::get('/ticketserv', 'TicketServController@index');
        Route::get('/ticketserv/getDispo', 'TicketServController@getDispo');
        Route::get('/ticketserv/getDispoA', 'TicketServController@getDispoA');
        Route::get('/ticketserv/getDispoI', 'TicketServController@getDispoI');
        Route::post('/ticketserv/registrar', 'TicketServController@store');

        Route::get('/tpestacion', 'TpEstacionController@index');
        Route::post('/tpestacion/registrar', 'TpEstacionController@store');
        Route::put('/tpestacion/actualizar', 'TpEstacionController@update');
        Route::post('/tpestacion/eliminar', 'TpEstacionController@destroy');
        Route::get('/tpestacion/selectTpEstacion', 'TpEstacionController@selectTpEstacion');
        Route::get('/tpestacion/selectCategoria', 'CategoriaController@selectCategoria');
        
        Route::get('/tpequipo', 'TpEquipoController@index');
        Route::post('/tpequipo/registrar', 'TpEquipoController@store');
        Route::put('/tpequipo/actualizar', 'TpEquipoController@update');
        Route::post('/tpequipo/eliminar', 'TpEquipoController@destroy');
        Route::get('/tpequipo/selectTpEquipo', 'TpEquipoController@selectTpEquipo');
        
        Route::get('/tpmaterial', 'TpMaterialController@index');
        Route::post('/tpmaterial/registrar', 'TpMaterialController@store');
        Route::put('/tpmaterial/actualizar', 'TpMaterialController@update');
        Route::post('/tpmaterial/eliminar', 'TpMaterialController@destroy');
        Route::get('/tpmaterial/selectTpMaterial', 'TpMaterialController@selectTpMaterial');
        
        Route::get('/trenetapa/selectTrenEtapa', 'TrenEtapaController@selectTrenEtapa');
  
        Route::get('/user', 'UserController@index');
        Route::get('user/export/', 'UserController@export');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'ventaController@store');
        Route::put('/venta/desactivar', 'ventaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'ventaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'ventaController@obtenerDetalles');


    });

});

//Route::get('/home', 'HomeController@index')->name('home');
