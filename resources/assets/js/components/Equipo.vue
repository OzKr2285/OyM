<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestion de Equipos
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <template v-if="listado==1">
            <div class="md-layout">
              <div class="md-layout-item">
                <md-field md-clearable>
                  <label>Qué desea Buscar</label>
                  <md-input v-model="buscar" @keypress="listarEquipo(1,buscar,criterio)"></md-input>
                </md-field>
              </div>&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <br />
                <md-button
                  class="md-icon-button md-dense md-raised md-primary"
                  @click="listarEquipo(1,buscar,criterio)"
                >
                  <md-icon>search</md-icon>
                </md-button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>TAG</th>
                    <th>Serial</th>
                    <th>Nombre</th>
                    <th>Modelo</th>
                    <th>Proveedor</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`">
                    <td v-text="equipo.tag"></td>
                    <td v-text="equipo.serial"></td>
                    <td v-text="equipo.nomref"></td>
                    <td v-text="equipo.modelo"></td>
                    <td v-text="equipo.nomprov"></td>
                    <td>
                    <md-button class="md-icon-button " @click="mostrarActualizar(equipo)" title="Actualizar">                         
                      <i class="material-icons Color3">edit</i>
                    </md-button>
                    <md-button class="md-icon-button md-primary " @click="eliminarEquipo(equipo)" title="Eliminar">
                      <i class="material-icons Color4">delete</i>
                    </md-button>
                 
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                  >Ant</a>
                </li>
                <li
                  class="page-item"
                  v-for="page in pagesNumber"
                  :key="page"
                  :class="[page == isActived ? 'active' : '']"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(page,buscar,criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                  >Sig</a>
                </li>
              </ul>
            </nav>
          </template>

          <template v-else-if="listado==0">
            <div class="card-body">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                <md-card-content>
                  <div class="md-layout">
                    <div class="md-layout-item md-size-30">
                      <md-field md-clearable>
                        <label>Tipo de Equipo</label>
                        <md-select v-model="idTpEquipo" md-dense @input="getRefE">
                          <md-option
                            v-for="(tpequipo,index) in arrayTpEquipo"
                            :key="`tpequipo-${index}`"
                            :value="tpequipo.id"
                          >{{tpequipo.nombre}}</md-option>
                        </md-select>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item md-size-50">
                      <md-field md-clearable>
                        <label>Referencia del Equipo</label>
                        <md-select v-model="idRefEquipo" md-dense>
                          <md-option
                            v-for="(refequipo,index) in arrayRefEquipo"
                            :key="`refequipo-${index}`"
                            :value="refequipo.id"
                          >{{refequipo.nombre}}</md-option>
                        </md-select>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item md-size-15">
                      <md-field md-clearable>
                        <label>TAG</label>
                        <md-input autocomplete="given-name" v-model="tag" :disabled="sending" />
                      </md-field>
                    </div>
                    <!--                   
                  <div class="md-layout-item" v-show="mostrarA==1">
                    <md-field md-clearable>
                      <label>Actualizar Proveedor</label>
                      <md-select v-model="idproveedor" md-dense>
                        <md-option
                          v-for="(prov) in arrayProveedor"
                          :key="prov.id"
                          :value="prov.id"
                        >{{prov.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
                  <div class="md-layout-item" v-show="mostrarR==1">
                    <span>Seleccione un Proveedor</span>
                    <v-select
                      :on-search="selectProveedor"
                      label="nombre"
                      :options="arrayProveedor"
                      placeholder="Buscar Proveedores..."
                      :onChange="getDatosProveedor"
                    ></v-select>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;-->
                  </div>
                  <!-- 
                <div class="md-layout" v-show="mostrarL==1">
                  <md-field v-for="(prov) in arrayProveedor" :key="prov.id" :value="prov.id">
                    <label>
                      Contactar a
                      <b>{{prov.contacto}}</b> al número telefónico
                      <b>{{prov.telefono}}</b> o email
                      <b>{{prov.email}}</b>
                    </label>
                  </md-field>
                  </div>-->

                  <div class="md-layout">
                    <div class="md-layout-item" v-show="mostrarA==1">
                      <md-field md-clearable>
                        <label>Actualizar Proveedor</label>
                        <md-select v-model="idproveedor" md-dense>
                          <md-option
                            v-for="(prov) in arrayProveedor"
                            :key="prov.id"
                            :value="prov.id"
                          >{{prov.nombre}}</md-option>
                        </md-select>
                      </md-field>
                    </div>
                    <div class="md-layout-item" v-show="mostrarR==1">
                      <span>.</span>
                      <v-select
                        :on-search="selectProveedor"
                        label="nombre"
                        :options="arrayProveedor"
                        placeholder="Buscar Proveedores..."
                        :onChange="getDatosProveedor"
                      ></v-select>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label>Marca</label>
                        <md-select v-model="idMarca" md-dense @input="getModelo">
                          <md-option
                            v-for="marca in arrayMarca"
                            :key="marca.id"
                            :value="marca.id"
                          >{{marca.nombre}}</md-option>
                        </md-select>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label>Modelo</label>
                        <md-select v-model="idModelo" md-dense>
                          <md-option
                            v-for="modelo in arrayModelo"
                            :key="modelo.id"
                            :value="modelo.id"
                          >{{modelo.nombre}}</md-option>
                        </md-select>
                      </md-field>
                    </div>
                  </div>

                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field :class="getValidationClass('serial')">
                        <label>Serial</label>
                        <md-input
                          autocomplete="given-name"
                          v-model="form.serial"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.serial.required"
                        >El Serial es requerido</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field :class="getValidationClass('numFac')">
                        <label>Número de Factura</label>
                        <md-input
                          autocomplete="given-name"
                          v-model="form.numFac"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.numFac.required"
                        >El numero de Factura es requerido</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label>Responsable</label>
                        <md-select v-model="idResponsable" md-dense>
                          <md-option
                            v-for="perso in arrayPerso"
                            :key="perso.id"
                            :value="perso.id"
                          >{{perso.nombreFull}}</md-option>
                        </md-select>
                      </md-field>
                    </div>
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <!-- <md-datepicker v-model="fecCompra" md-immediately/> -->
                      <!-- <div class="value">valor {{date}}</div> -->
                      <md-datepicker
                        v-model="fecCompra"
                        value="fecCompra"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                      >
                        <label>Fecha de Compra</label>
                      </md-datepicker>
                 </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                    <md-datepicker
                        v-model="fecGarantia"
                        value="fecGarantia"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                      >
                        <label>Fecha de Garantia</label>
                      </md-datepicker> 
                      </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-datepicker
                        v-model="fecInstala"
                        value="fecInstala"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                      >
                        <label>Fecha de Instalación</label>
                      </md-datepicker> 
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>

                  <div class="md-layout">
                    <md-field>
                      <label>Descripción</label>
                      <md-textarea v-model="form.descripcion"></md-textarea>
                    </md-field>
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field :class="getValidationClass('linke')">
                        <label>Link</label>
                        <md-input
                          autocomplete="given-name"
                          v-model="form.linke"
                          :disabled="sending"
                        />
                        <span class="md-error" v-if="!$v.form.linke.required">El Serial es requerido</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>
                    </div>
                    <div class="md-layout-item">
                      <md-field>
                        <label>Subir archivos</label>
                        <md-file v-model="datasheet" placeholder="Seleccione el Datasheet" />
                      </md-field>
                    </div>
                    <div class="md-layout-item md-size-15">
                      <md-switch v-model="demo" @change="abrirModal">Accesorios</md-switch>
                    </div>
                  </div>
                </md-card-content>
              </form>
              <h4>Accesorios</h4>
              <div class="table-responsive col-md-12">
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Modelo</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody v-if="arrayDetEquipo.length">
                    <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                    <tr v-for="(detalle, index) in arrayDetEquipo" :key="`detalle-${index}`">
                      <td v-text="detalle.serial"></td>
                      <td v-text="detalle.nombre"></td>
                      <td v-text="detalle.desc"></td>
                      <td v-text="detalle.modelo"></td>

                      <td>
                        <button
                          @click="eliminarAccesorio(detalle)"
                          type="button"
                          class="btn btn-danger btn-sm"
                        >
                          <i class="icon-close"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="5">NO hay Accesorios agregados</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <md-card-actions>
                <md-button type="button" class="md-raised" @click="ocultarDetalle()">Cerrar</md-button>
              </md-card-actions>

              <md-card-actions>
                <md-button
                  type="submit"
                  v-if="tipoAccion==1"
                  class="md-dense md-raised md-primary"
                  :disabled="sending"
                  @click="validarDatos()"
                >Guardar</md-button>
                <md-button
                  type="submit"
                  v-if="tipoAccion==2"
                  class="md-dense md-raised md-primary"
                  :disabled="sending"
                  @click="actualizarEquipo()"
                >Actualizar</md-button>
              </md-card-actions>
            </div>
          </template>
        </div>
      </div>

      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->

    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Serial">Serial</option>
                    <option value="nombre">Nombre</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarAccesorio(1,buscar,criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarAccesorio(1,buscar,criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Modelo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(detequipo, index)  in arrayAccesorio" :key="`detequipo-${index}`">
                    <td>
                      <button
                        type="button"
                        @click="agregarDetalleModal(detequipo)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="detequipo.nombre"></td>
                    <td v-text="detequipo.desc"></td>
                    <td v-text="detequipo.modelo"></td>
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaA(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                  </li>
                  <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                  >
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaA(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaA(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
        <!-- /.modal-dialog -->
      </div>
    </div>
    <!-- /.modal-dialog -->

    <!--Fin del modal-->
  </main>
</template>

<script>
  import parse from 'date-fns/parse'
  // import { parseISO, format } from 'date-fns' ...
  import format from 'date-fns/format'
  // import isValid from 'date-fns/isValid'
// var moment = require('moment');
// import moment from 'moment';

import { validationMixin } from "vuelidate";

import vSelect from "vue-select";
import {
  MdButton,  
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdSwitch,
  MdDatepicker,
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);

Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdSwitch);
Vue.use(MdList);
Vue.use(MdDatepicker);
import { required, minLength } from "vuelidate/lib/validators";
// import { MdDatepicker } from 'vue-material/dist/components';

export default {
  mixins: [validationMixin],

  data() {
    
     
    let dateFormat = this.$material.locale.dateFormat || 'yyyy-MM-dd';
    
    // let dateFormat = moment.defaultFormat = "YYYY-MM-DD";
    let now = new Date();
    return {
      // shorterDays: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
 
      date: now,
      fecCompra: format(now, dateFormat),
      fecInstala: format(now, dateFormat),
      fecGarantia: format(now, dateFormat),

      fecCompra: now,
      fecGarantia: now,
      fecInstala: now,
      mdTypeValue: "string",
      // dynamicByMdType: now,

      nombre: "",
      form: {
        descripcion: "",
        numFac: "",
        linke: "www.",
        serial: ""
      },
      criterioA: "nombre",
      buscarA: "",
      demo: 0,
      mostrarR: 0,
      mostrarA: 0,
      mostrarL: 0,
      modelo: 0,
      idproveedor: 0,
      idMarca: 0,
      idModelo: 0,
      idResponsable: 0,
      idEquipo: "",
      idTpEquipo: "",
      idRefEquipo: "",
      idRefEquipo: "",
      tag: "",
      idAccesorio: "",

      desc: "",
      rgTemp: 0,
      rgPresion: 0,
      rgFlujo: 0,
      datasheet: "",

      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayMarca: [],
      arrayCriterio: ["Nombre", "Modelo"],
      arrayEquipoPpal: [],
      arrayEquipoByPass: [],
      arrayTpEquipo: [],
      arrayRefEquipo: [],
      arrayPerso: [],
      arrayProveedor: [],
      arrayAccesorio: [],
      arrayDetalle: [],
      arrayDetEquipo: [],
      arrayDetEquipoAct: [],
      arrayEquipo: [],
      arrayModelo: [],
      modelos: [
        "No Aplica",
        "2020",
        "2019",
        "2018",
        "2017",
        "2016",
        "2015",
        "2014",
        "2013",
        "2012",
        "2011",
        "2010",
        "2009",
        "2008",
        "2007",
        "2006",
        "2005",
        "2004",
        "2003",
        "2002",
        "2001",
        "2010",
        "1999",
        "1998",
        "1997",
        "1996",
        "1995",
        "1994",
        "1993",
        "1992",
        "1991",
        "1990",
        "1989",
        "1988",
        "1987",
        "1986",
        "1985"
      ],
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,

      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },

      offset: 3,
      criterio: "Nombre",
      buscar: ""
    };
  },
  components: {
    vSelect
  },

  validations: {
    form: {
      numFac: {
        required
      },
      linke: {
        required
      },
      serial: {
        required
      }
    }
  },

  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },

    submittableDateTime() {
      const date = new Date(this.date);

      console.log(date);
      return date;
    },

    dateFormat() {
      return this.$material.locale.dateFormat ||"YYYY-MM-dd";
      // return moment(date).format('LL')
    },
    mdType() {
      switch (this.mdTypeValue) {
        case "fecCompra":
          return String;
      }
    }
  },
  methods: {
    toDate() {
      switch (this.type) {
        case "null":
          this.fecCompra = null;
          this.fecInstala = null;
          this.fecGarantia = null;
          break;

          case "fecCompra":
            this.fecCompra = parseISO(
            this.fecCompra
          );
          break;       
          case "fecInstala":
          this.fecInstala = parseISO(
            this.fecInstala
          );
          break;
        case "fecGarantia":
          this.fecGarantia = parseISO(
            this.fecGarantia
          );
          break;
      }
    },
    toString() {
      // this.toDate();
    // this.fecCompra =moment(this.fecCompra).format("YYYY-MM-DD");
    // this.fecInstala =moment(this.fecInstala).format("YYYY-MM-DD");
    // this.fecGarantia =moment(this.fecGarantia).format("YYYY-MM-DD");
      // this.fecCompra =
      //   this.fecCompra && format(this.fecCompra, this.dateFormat);
    //   this.fecInstala =
    //     this.fecInstala && format(this.fecInstala, this.dateFormat);
    //   this.fecGarantia =
    //     this.fecGarantia && format(this.fecGarantia, this.dateFormat);
    },
    toNumber() {
      this.toDate();
      this.dynamicByModel = this.dynamicByModel && Number(this.dynamicByModel);
    },
    cerrarModal() {
      this.modal = 0;
      this.demo = 0;
      this.tituloModal = "";
    },
    abrirModal() {
      this.modal = 1;
      this.tituloModal = "Seleccione uno o varios Accesorios";
    },
    getValidationClass(fieldName) {
      const field = this.$v.form[fieldName];
      if (field) {
        return {
          "md-invalid": field.$invalid && field.$dirty
        };
      }
    },
    validarDatos() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.registrarEquipo();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.arrayProveedor = [];
      this.arrayDetEquipo = [];
      this.arrayDetEquipoAct = [];
      this.mostrarR = 1;
      this.mostrarA = 0;
      this.mostrarL = 1;
      this.form.nombre = null;
      this.form.descripcion = null;
      this.form.linke = "";
      this.form.serial = "";
      this.idproveedor = "";
      this.form.numFac = "";
      this.idMarca = "";
      this.idTpEquipo = "";
      this.idRefEquipo = "";
      this.idModelo = "";
      this.fec_compra = "";
      this.fecGarantia = "";
      this.fec_instala = "";
      this.direccion = "";
      this.idResponsable = "";
      this.datasheet = "";
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetEquipo.length; i++) {
        if (this.arrayDetEquipo[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarDetalleModal(data = []) {
      let me = this;

      if (me.encuentra(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese Accesorio ya se encuentra agregado!"
        });
      } else {
        me.arrayDetEquipo.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"],
          modelo: data["modelo"],
          serial: data["serial"]
        });
        me.arrayDetEquipoAct.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"],
          modelo: data["modelo"],
          serial: data["serial"],
        });
      }
    },

    eliminarDetalle(index) {
      let me = this;
      me.arrayDetalle.splice(index, 1);
    },
    listarAccesorio(page, buscar, criterio) {
      let me = this;
      var url =
        "/accesorio?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayAccesorio = respuesta.accesorio.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    selectProveedor(search, loading) {
      let me = this;
      loading(true);

      var url = "/proveedor/selectProveedor?filtro=" + search;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          q: search;
          me.arrayProveedor = respuesta.proveedores;
          loading(false);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getProveedor() {
      let me = this;

      var url = "/proveedor/getProveedor";
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;

          me.arrayProveedor = respuesta.proveedores;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // opcion que seleccion en el select
    getDatosProveedor(val1) {
      let me = this;
      me.loading = true;
      me.idproveedor = val1.id;
    },
    getMarca() {
      let me = this;

      var url = "/marca/selectMarca";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayMarca = respuesta.marca;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getModelo() {
      let me = this;

      var url = "/modelo/selectModelo?buscar=" + this.idMarca;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayModelo = respuesta.modelo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getRefE() {
      let me = this;

      var url = "/refequipo/selectRefEquipo?buscar=" + this.idTpEquipo;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayRefEquipo = respuesta.refequipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getPerso() {
      let me = this;

      var url = "/persona/selectPersona";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayPerso = respuesta.perso;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getTpEquipo() {
      let me = this;

      var url = "/tpequipo/selectTpEquipo";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTpEquipo = respuesta.tpequipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    mostrarDetalle() {
      this.clearForm();
      this.getTpEquipo();
      this.getMarca();
      this.getPerso();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
      this.listarEquipo(1, this.buscar, this.criterio);
    },
    listarEquipo(page, buscar, criterio) {
      let me = this;
      var url =
        "/equipo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEquipo = respuesta.equipo.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetEquipo(page, buscar, criterio) {
      let me = this;
      var url =
        "/detequipo/?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetEquipo = respuesta.detequipo.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarEquipo(page, buscar, criterio);
    },
    cambiarPaginaA(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarAccesorio(page, buscar, criterio);
    },

    registrarEquipo() {
      let me = this;

      axios
        .post("/equipo/registrar", {
          id_proveedor: this.idproveedor,
          id_refequipo: this.idRefEquipo,
          id_responsable: this.idResponsable,
          tag: this.tag,
          desc: this.form.descripcion.toUpperCase(),
          num_fac: this.form.numFac,
          serial: this.form.serial,
          id_modelo: this.idModelo,
          fec_compra: this.fecCompra,
          fec_garantia: this.fecGarantia,
          fec_instala: this.fecInstala,
          link: this.form.linke,
          datachip: this.datasheet,
          data: this.arrayDetEquipo
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarEquipo(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarActualizar(data = []) {
      this.arrayDetEquipoAct = [];
      this.getProveedor();
      this.getTpEquipo();
      this.getPerso();
      this.getMarca();

      this.idEquipo = data["ide"];
      this.listarDetEquipo(1, this.idEquipo, "");

      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      this.mostrarR = 0;
      this.mostrarA = 1;
      this.mostrarL = 0;

      this.idproveedor = data["id_proveedor"];
      this.idResponsable = data["id_responsable"];
      this.idTpEquipo = data["id_refequipo"];
      this.idRefEquipo = data["id_refequipo"];
      this.idModelo = data["idmodelo"];
      this.idMarca = data["idmarca"];
      this.tag = data["tag"];
      this.form.descripcion = data["desc"];
      this.form.numFac = data["num_fac"];
      this.form.serial = data["serial"];
      this.form.linke = data["link"];
      this.fecCompra = data["fec_compra"];
      this.fecGarantia = data["fec_garantia"];
      this.fecInstala = data["fec_instala"];
      this.getRefE();
      this.getModelo();
      this.datasheet = data["datachip"];
    },
    actualizarEquipo() {
      let me = this;

      axios
        .put("/equipo/actualizar", {
          id: this.idEquipo,
          id_proveedor: this.idproveedor,
          id_refequipo: this.idRefEquipo,
          id_responsable: this.idResponsable,
          tag: this.tag,
          desc: this.form.descripcion.toUpperCase(),
          num_fac: this.form.numFac,
          serial: this.form.serial,
          id_modelo: this.idModelo,
          fec_compra: this.fecCompra,
          fec_garantia: this.fecGarantia,
          fec_instala: this.fecInstala,
          link: this.form.linke,
          datachip: this.datasheet,

          data: this.arrayDetEquipoAct
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarEquipo(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    eliminarAccesorio(data = []) {
      swal({
        title: "Esta seguro de Eliminar el Accesorio " + data["nombre"],
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;
          this.idAccesorio = data["id"];
          axios
            .post("/detequipo/eliminar", {
              id: this.idAccesorio
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarAccesorio(1, "", "nombre");
              me.mensaje("Eliminado", "Eliminó ");
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
 eliminarEquipo(data = []) {
      swal({
        title: "Esta seguro de Eliminar este Equipo " + data["nomref"],
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;
          this.idDetEquipo = data["idDet"];
          axios
            .post("/equipo/eliminar", {
              id: this.idEquipo
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarAccesorio(1, "", "nombre");
              me.mensaje("Eliminado", "Eliminó ");
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    // this.listarAccesorio(1, this.buscar, this.criterio);
    // this.listarDetEquipo(1, this.idEquipo, "");
    // this.getProveedor();
    // this.getTpEquipo();
    // this.getMarca();
    // this.getPerso();
    this.listarEquipo(1, this.buscar, this.criterio);
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
.material-icons.Color1 { color: rgb(31, 33, 34); }
.material-icons.Color2 { color: rgba(223, 195, 37, 0.966); }
.material-icons.Color3 { color: rgb(12, 170, 91); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
