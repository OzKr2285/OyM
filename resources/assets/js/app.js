
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('tpestacion', require('./components/TpEstacion.vue'));
Vue.component('ciclo', require('./components/Ciclo.vue'));
Vue.component('mercado', require('./components/Mercado.vue'));
Vue.component('marca', require('./components/Marca.vue'));
Vue.component('modelo', require('./components/Modelo.vue'));
Vue.component('estacion', require('./components/Estacion.vue'));
Vue.component('fichaes', require('./components/Fichaes.vue'));
Vue.component('equipo', require('./components/Equipo.vue'));
Vue.component('ecomputo', require('./components/EquipoComputo.vue'));
Vue.component('tpequipo', require('./components/TpEquipo.vue'));
Vue.component('accesorio', require('./components/Accesorio.vue'));
Vue.component('fichaveh', require('./components/fichaveh.vue'));
Vue.component('ficharedes', require('./components/fichaRedes.vue'));
Vue.component('red', require('./components/Red.vue'));
Vue.component('fichapasose', require('./components/FichaPasosE.vue'));
Vue.component('etapa', require('./components/Etapa.vue'));
Vue.component('demo', require('./components/demo.vue'));
Vue.component('proveedor', require('./components/Proveedor.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('ingreso', require('./components/Ingreso.vue'));
Vue.component('tabdemo', require('./components/tabDemo.vue'));
Vue.component('cargo', require('./components/Cargo.vue'));
Vue.component('oficina', require('./components/Oficina.vue'));

// Programacion de Mantenimientos
Vue.component('mtoes', require('./components/MtoEs.vue'));
Vue.component('mtoec', require('./components/MtoEC.vue'));
Vue.component('mtoveh', require('./components/MtoVeh.vue'));
Vue.component('mtored', require('./components/MtoRed.vue'));
Vue.component('mtope', require('./components/MtoPE.vue'));
Vue.component('insumo', require('./components/Insumo.vue'));
Vue.component('insumoe', require('./components/InsumoE.vue'));
Vue.component('refequipo', require('./components/RefE.vue'));
Vue.component('actividad', require('./components/Actividad.vue'));
Vue.component('actividade', require('./components/ActividadE.vue'));
Vue.component('persona', require('./components/Persona.vue'));
Vue.component('tecnico', require('./components/Tecnico.vue'));
Vue.component('diametro', require('./components/Diametro.vue'));
Vue.component('marcaveh', require('./components/MarcaVeh.vue'));
Vue.component('linea', require('./components/Linea.vue'));
Vue.component('areas', require('./components/Area.vue'));
Vue.component('horario', require('./components/Horario.vue'));
Vue.component('tptramite', require('./components/TpTramite.vue'));
Vue.component('detcausal', require('./components/DetCausal.vue'));

// Gestion de PQR´S
Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('catserv', require('./components/CatServicio.vue'));
Vue.component('servicio', require('./components/Servicio.vue'));
Vue.component('objpqrs', require('./components/ObjPQRS.vue'));
Vue.component('ticketserv', require('./components/TicketServ.vue'));
Vue.component('ticketasignar', require('./components/TicketAsignar.vue'));
Vue.component('ticketservtec', require('./components/TicketServTec.vue'));

//Operacion
Vue.component('dispo', require('./components/Disponibilidad.vue'));
Vue.component('insta', require('./components/Instalacion.vue'));
Vue.component('tpmaterial', require('./components/TpMaterial.vue'));
Vue.component('refmaterial', require('./components/RefMaterial.vue'));
Vue.component('novedad', require('./components/Novedad.vue'));

const app = new Vue({
    el: '#app',
    
    data :{
        menu : 0
    }
});
