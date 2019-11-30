<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión de Vehículos
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Asignado</th>
                    <th>SOAT</th>
                    <th>Tecnomecánica</th>
                    <th>Ref. Aceite</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(veh,index) in arrayVehiculo" :key="`veh-${index}`">
                    <td v-text="veh.placa"></td>
                    <td v-text="veh.tipo"></td>
                    <td v-text="veh.nombreFull"></td>
                    <td v-text="veh.fec_soat"></td>
                    <td v-text="veh.fec_tecno"></td>
                    <td v-text="veh.ref_aceite"></td>
                    <td>
                      <md-button class="md-icon-button " @click="mostrarActualizar(veh)" title="Actualizar" >                         
                        <i class="material-icons Color3">edit</i>
                      </md-button>
                      <md-button class="md-icon-button md-primary " @click="eliminarEstacion(veh)" title="Eliminar">
                        <i class="material-icons Color4">delete</i>    
                      </md-button>               
                    </td>
                  </tr>
                </tbody>
              </table>
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
            </div>
          </div>
        </template>
        <template v-else-if="listado==0">
          <div class="card-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <h5>Información General</h5>
                <md-divider/>
                <div class="md-layout">
                  <!-- inicio de elementos  -->

                  <div class="md-layout-item md-size-10">
                    <md-field :class="getValidationClass('placa')" md-clearable>
                      <label>N° de Placa</label>
                      <md-input
                        autocomplete="given-name"
                        v-model="form.placa"
                        :disabled="sending"
                        @change="getPerso"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.placa.required"
                      >El numero de Placa es requerido</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-25">
                    <md-field :class="getValidationClass('nchasis')" md-clearable>
                      <label>Número de Chasis</label>
                      <md-input
                        @change="getArea"
                        autocomplete="given-name"
                        v-model="form.nchasis"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nchasis.required"
                      >El numero de Chasis es requerido</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-datepicker
                      v-model="fecSOAT"
                      value="fecSOAT"
                      @input="toString"
                      md-immediately
                      :md-model-type="String"
                    >
                      <label>Fecha de SOAT</label>
                    </md-datepicker>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-datepicker
                      v-model="fecTecno"
                      value="fecTecno"
                      @input="toString"
                      md-immediately
                      :md-model-type="String"
                    >
                      <label>Fecha Tecnomecánica</label>
                    </md-datepicker>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-40">
                    <md-field md-clearable>
                      <label>Asignado a:</label>
                      <md-select v-model="idAsignado" md-dense>
                        <md-option
                          v-for="perso in arrayPerso"
                          :key="perso.id"
                          :value="perso.id"
                        >{{perso.nombreFull}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Área</label>
                      <md-select v-model="idArea" @input="getCargo" md-dense>
                        <md-option
                          v-for="area in arrayArea"
                          :key="area.id"
                          :value="area.id"
                        >{{area.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Cargo</label>
                      <md-select v-model="idCargo" @input="getMarca" md-dense>
                        <md-option
                          v-for="cargo in arrayCargo"
                          :key="cargo.id"
                          :value="cargo.id"
                        >{{cargo.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
                </div>

                <div class="md-layout"></div>

                <h5>Información Técnica</h5>
                <md-divider/>
                <div class="md-layout">
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Tipo Vehículo</label>
                      <md-select v-model="tpVeh" md-dense>
                        <md-option
                          v-for="tipoVeh in arrayTpVeh"
                          :key="tipoVeh.id"
                          :value="tipoVeh"
                        >{{tipoVeh}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Marca</label>
                      <md-select v-model="idMarcaVeh" @input="getLinea" md-dense>
                        <md-option
                          v-for="marca in arrayMarca"
                          :key="marca.id"
                          :value="marca.id"
                        >{{marca.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Linea</label>
                      <md-select v-model="idLinea" md-dense>
                        <md-option
                          v-for="linea in arrayLinea"
                          :key="linea.id"
                          :value="linea.id"
                        >{{linea.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Modelo</label>
                      <md-select v-model="modelo" md-dense>
                        <md-option
                          v-for="modelo in modelos"
                          :key="modelo.id"
                          :value="modelo"
                        >{{modelo}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-15">
                    <md-field md-clearable>
                      <label>Cilindraje</label>
                      <md-input type="number" v-model="cilindraje"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Tracción</label>
                      <md-select v-model="traccion" md-dense>
                        <md-option
                          v-for="trac in arrayTraccion"
                          :key="trac.id"
                          :value="trac"
                        >{{trac}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Combustible</label>
                      <md-select v-model="tpCombs" md-dense>
                        <md-option
                          v-for="combs in arrayTpCombs"
                          :key="combs.id"
                          :value="combs"
                        >{{combs}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-15">
                    <md-field md-clearable>
                      <label>Color</label>
                      <md-input v-model="color"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-15">
                    <md-field md-clearable>
                      <label>Kilometraje</label>
                      <md-input type="number" v-model="km"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Km - Cambio</label>
                      <md-input type="number" v-model="cambio"></md-input>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-15">
                    <md-field md-clearable>
                      <label>Tamaño del Rin</label>
                      <md-select v-model="tpRin" md-dense>
                        <md-option v-for="rin in arrayRin" :key="rin.id" :value="rin">{{rin}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-10">
                    <md-field md-clearable>
                      <label>N° de Llantas</label>
                      <md-input type="number" v-model="numLlantas"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-20">
                    <md-field md-clearable>
                      <label>Ref. Aceite</label>
                      <md-input v-model="aceite"></md-input>
                    </md-field>
                  </div>
                  <div class="md-layout-item">
                    <md-datepicker
                      v-model="fecCompra"
                      value="fecCompra"
                      @input="toString"
                      md-immediately
                      :md-model-type="String"
                    >
                      <label>Fecha de Compra</label>
                    </md-datepicker>
                  </div>
                </div>
                <div class="md-layout">
                  <md-field>
                    <label>Descripción</label>
                    <md-textarea v-model="descripcion"></md-textarea>
                  </md-field>
                </div>

                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-switch v-model="demo2" @change="abrirModal2">Agregar Imágen</md-switch>
                  </div>
                  <div class="md-layout-item">
                    <md-switch v-model="demo" @change="abrirModal">Novedades</md-switch>
                  </div>
                </div>
              </md-card-content>
            </form>
            <h4>Historial</h4>
            <div class="table-responsive col-md-12">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Tipo de Novedad</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Realizado por</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayNovedad.length">
                  <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                  <tr v-for="(detalle, index) in arrayNovedad" :key="`detalle-${index}`">
                    <td v-text="detalle.nombre"></td>
                    <td v-text="detalle.fecha"></td>
                    <td v-text="detalle.desc"></td>
                    <td v-text="detalle.responsable"></td>

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
                    <td colspan="5">NO hay Novedades agregadas</td>
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
              <label class="col-md-2 form-control-label" for="text-input">Novedad</label>
              <div class="col-md-12">
                <select class="form-control" v-model="idNovedad">
                  <option value="0" disabled>Seleccione</option>
                  <option
                    v-for="novedad in arrayNovedad"
                    :key="novedad.id"
                    :value="novedad.id"
                    v-text="novedad.nombre"
                  ></option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 form-control-label" for="text-input">Realizado por</label>
              <div class="col-md-12">
                <select class="form-control" v-model="idResponsable">
                  <option value="0" disabled>Seleccione</option>
                  <option
                    v-for="perso in arrayPerso"
                    :key="perso.id"
                    :value="perso.id"
                    v-text="perso.nombreFull"
                  ></option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-1 form-control-label" for="text-input">Descripción</label>
              <div class="col-md-12">
                <textarea v-model="desc" class="form-control" rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="registrarNovedad()">Registrar</button>
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- /.modal-dialog -->

    <!--Fin del modal-->

    <!-- Modal para anexar fotos -->

    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal2}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal2()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <template>
              <div
                class="uploader"
                @dragenter="OnDragEnter"
                @dragleave="OnDragLeave"
                @dragover.prevent
                @drop="onDrop"
                :class="{ dragging: isDragging }"
              >
                <div class="upload-control" v-show="images.length">
                  <label for="file">Anexar otra Imágen</label>
                  <button @click="upload">Almacenar</button>
                </div>

                <div v-show="!images.length">
                  <i class="fa fa-cloud-upload"></i>
                  <p>Arrastra tus imágenes aquí</p>
                  <div>O</div>
                  <div class="file-input">
                    <label for="file">Selecciona una Imágen</label>
                    <input type="file" id="file" @change="onInputChange" multiple>
                  </div>
                </div>

                <div class="images-preview" v-show="images.length">
                  <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                    <img :src="image" :alt="`Image Uplaoder ${index}`">
                    <div class="details">
                      <span class="name" v-text="files[index].name"></span>
                      <span class="size" v-text="getFileSize(files[index].size)"></span>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="upload()">Registrar</button>
            <button type="button" class="btn btn-secondary" @click="cerrarModal2()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </main>
</template>

<script>
import format from "date-fns/format";

import { validationMixin } from "vuelidate";

import vSelect from "vue-select";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdSwitch,
  MdDivider,
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
Vue.use(MdDivider);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  data() {
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();
    return {
      isDragging: false,
      dragCount: 0,
      files: [],
      images: [],

      date: now,
       fecCompra: format(now, dateFormat),
      fecGarantia: format(now, dateFormat),
      fecInstala: format(now, dateFormat),

      // fecCompra: now,
      // fecSOAT: now,
      // fecTecno: now,
      // mdTypeValue: "string",
      dynamicByMdType: now,

      form: {
        nombre: "",
        placa: "",
        nchasis: ""
      },
      buscarA: "",
      demo: 0,
      demo2: 0,
      mostrarR: 0,
      mostrarA: 0,
      mostrarL: 0,
      modelo: 0,
      idMarcaVeh: 0,
      idLinea: 0,
      idAsignado: 0,
      idResponsable: 0,
      idEquipo: "",
      idNovedad: "",
      idArea: "",
      idCargo: "",

      descripcion: "",
      desc: "",
      tpVeh: "",
      color: "",
      km: 0,
      cilindraje: 0,
      datasheet: "",
      tpRin: "",
      numLlantas: "",
      tpCombs: "",
      aceite: "",
      traccion: "",
      cambio: "",

      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayVehiculo: [],
      arrayMarca: [],
      arrayLinea: [],
      arrayEquipo: [],
      arrayNovedad: [],
      arrayAccesorio: [],
      arrayArea: [],
      arrayPerso: [],
      arrayCargo: [],
      arrayTpVeh: [
        "Automóvil",
        "Autobús",
        "Camión",
        "Camioneta",
        "Furgón",
        "Motocicleta",
        "Motocarro",
        "Remolque",
        "Tractocamión"
      ],
      arrayTpCombs: ["Gas", "Gasolina", "Diesel","No Aplica"],
      arrayTraccion: ["AWD", "4WD", "4X4", "FWD", "RWD", "No Aplica"],
      arrayRin: [
        "No Aplica",
        "8",
        "10",
        "12",
        "13",
        "14",
        "15",
        "16",
        "17",
        "18",
        "19",
        "20",
        "22",
        "23",
        "24",
        "26",
        "28"
      ],

      modelos: [
        "No Aplica",
        "2022",
        "2021",
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
      modal2: 0,
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
      criterio: "nombre",
      buscar: ""
    };
  },
  components: {
    vSelect
  },

  validations: {
    form: {
      nchasis: {
        required
      },
      placa: {
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
      return this.$material.locale.dateFormat || "yyyy-MM-dd";
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
    OnDragEnter(e) {
      e.preventDefault();

      this.dragCount++;
      this.isDragging = true;

      return false;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;

      if (this.dragCount <= 0) this.isDragging = false;
    },
    onInputChange(e) {
      const files = e.target.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();

      this.isDragging = false;

      const files = e.dataTransfer.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.files.push(file);

      const img = new Image(),
        reader = new FileReader();

      reader.onload = e => this.images.push(e.target.result);

      reader.readAsDataURL(file);
    },
    getFileSize(size) {
      const fSExt = ["Bytes", "KB", "MB", "GB"];
      let i = 0;

      while (size > 900) {
        size /= 1024;
        i++;
      }

      return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
    },
    upload() {
      let me = this;
      const formData = new FormData();

      this.files.forEach(file => {
        formData.append("images[]", file, file.name);
      });

      axios.post("/demo/registrar", formData).then(response => {
        me.mensaje("Guardado", "Todas las imagenes se han almacenado ");
        // this.$toastr.s("All images uplaoded successfully");
        this.images = [];
        this.files = [];
      });
    },
    toDate() {
      switch (this.type) {
        case "null":
          this.fecCompra = null;
          break;

        case "fecCompra":
          this.fecCompra = parse(this.fecCompra, this.dateFormat, new Date());
          break;
        case "fecTecno":
          this.fecInstala = parse(this.fecInstala, this.dateFormat, new Date());
          break;
        case "fecSOAT":
          this.fecSOAT = parse(this.fecSOAT, this.dateFormat, new Date());
          break;
      }
    },
    toString() {
      this.toDate();
            this.dynamicByModel =
        this.dynamicByModel && format(this.dynamicByModel, this.dateFormat);
      // this.fecCompra =
      //   this.fecCompra && format(this.fecCompra, this.dateFormat);
      // this.fecTecno = this.fecTecno && format(this.fecTecno, this.dateFormat);
      // this.fecSOAT = this.fecSOAT && format(this.fecSOAT, this.dateFormat);
    },

    cerrarModal() {
      this.listarNovedad(1, this.form.placa);
      this.modal = 0;
      this.demo = 0;
      this.tituloModal = "";
    },
    cerrarModal2() {
      this.modal2 = 0;
      this.tituloModal = "";
    },
    abrirModal() {
      this.getPerso();
      this.getNovedad();
      this.modal = 1;
      this.tituloModal = "Registro de  Novedades";
    },
    abrirModal2() {
      this.modal2 = 1;
      this.tituloModal = "Agregar Imágenes";
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
        this.registrarVehiculo();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();

      this.form.placa = "";
      this.form.nchasis = "";
      this.fecSOAT = "";
      this.fecTecno = "";
      this.idAsignado = "";
      this.idCargo = "";
      this.tpVeh = "";
      this.idMarcaVeh = "";
      this.modelo = "";
      this.cilindraje = "";
      this.traccion = "";
      this.tpCombs = 0;
      this.color = "";
      this.km = 0;
      this.tpRin = "";
      this.nllantas = "";
      this.cambio = "";
      this.aceite = "";
      this.fecCompra = "";
      this.descripcion = "";
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
    // agregarDetalleModal(data = []) {
    //   let me = this;

    //   if (me.encuentra(data["id"])) {
    //     swal({
    //       type: "error",
    //       title: "Error...",
    //       text: "Ese Accesorio ya se encuentra agregado!"
    //     });
    //   } else {
    //     me.arrayDetEquipo.push({
    //       id: data["id"],
    //       nombre: data["nombre"],
    //       desc: data["desc"],
    //       modelo: data["modelo"],
    //       serial: data["serial"],
    //       rg_temp: data["reg_temp"],
    //       rg_presion: data["reg_presion"],
    //       rg_flujo: data["rg_flujo"]
    //     });
    //     me.arrayDetEquipoAct.push({
    //       id: data["id"],
    //       nombre: data["nombre"],
    //       desc: data["desc"],
    //       modelo: data["modelo"],
    //       serial: data["serial"],
    //       rg_temp: data["reg_temp"],
    //       rg_presion: data["reg_presion"],
    //       rg_flujo: data["rg_flujo"]
    //     });
    //   }
    // },

    // eliminarDetalle(index) {
    //   let me = this;
    //   me.arrayDetalle.splice(index, 1);
    // },
    listarVehiculo(page, buscar, criterio) {
      let me = this;
      var url =
        "/fichaveh?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayVehiculo = respuesta.fichaveh.data;
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
    getCargo() {
      let me = this;

      var url = "/cargo/selectCargo?buscar=" + this.idArea;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayCargo = respuesta.cargo;
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
    getNovedad() {
      let me = this;

      var url = "/novedad/selectNovedad";
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayNovedad = respuesta.novedad;
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

      var url = "/marcaveh/selectMarca";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayMarca = respuesta.marcaveh;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getLinea() {
      let me = this;

      var url = "/linea/selectLinea?buscar=" + this.idMarcaVeh;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayLinea = respuesta.linea;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getArea() {
      let me = this;

      var url = "/area/selectArea";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayArea = respuesta.area;
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

    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
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

    registrarVehiculo() {
      let me = this;

      axios
        .post("/fichaveh/registrar", {
          id: this.form.placa,
          nchasis: this.form.nchasis,
          fec_soat: this.fecSOAT,
          fec_tecno: this.fecTecno,
          id_asignado: this.idAsignado,
          id_cargo: this.idCargo,
          tipo: this.tpVeh,
          id_linea: this.idMarcaVeh,
          modelo: this.modelo,
          cilindraje: this.cilindraje,
          traccion: this.traccion,
          combustible: this.tpCombs,
          color: this.color,
          km: this.km,
          rin: this.tpRin,
          nllantas: this.numLlantas,
          km_cambio: this.cambio,
          ref_aceite: this.aceite,
          fec_compra: this.fecCompra,
          desc: this.descripcion
          // data: this.arrayDetEquipo
        })
        .then(function(response) {
          // me.ocultarDetalle();
          // me.listarEquipo(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    registrarNovedad() {
      let me = this;

      axios
        .post("/noveh/registrar", {
          id_placa: this.form.placa,
          id_novedad: this.idNovedad,
          desc: this.desc,
          id_responsable: this.idResponsable,
          desc: this.desc
        })
        .then(function(response) {
          // me.ocultarDetalle();
          // me.listarEquipo(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarActualizar(data = []) {
      this.getMarca();
      this.getPerso();
      this.getArea();

      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);

      this.form.placa = data["placa"];
      this.form.nchasis = data["nchasis"];
      this.fecSOAT = data["fec_soat"];
      this.fecTecno = data["fec_tecno"];
      this.idAsignado = data["asignado"];
      this.idArea = data["area"];
      this.idCargo = data["cargo"];
      this.tpVeh = data["tipo"];
      this.idMarcaVeh = data["marca"];
      this.modelo = data["modelo"];
      this.cilindraje = data["cilindraje"];
      this.traccion = data["traccion"];
      this.tpCombs = data["combustible"];
      this.color = data["color"];
      this.km = data["km"];
      this.tpRin = data["rin"];
      this.numLlantas = data["nllantas"];
      this.cambio = data["km_cambio"];
      this.aceite = data["ref_aceite"];
      this.fecCompra = data["fec_compra"];
      this.descripcion = data["desc"];
      this.getCargo();
      this.listarNovedad(1, this.form.placa);
    },
    actualizarEquipo() {
      let me = this;

      axios
        .put("/fichaveh/actualizar", {
          id: this.form.placa,
          nchasis: this.form.nchasis,
          fec_soat: this.fecSOAT,
          fec_tecno: this.fecTecno,
          id_asignado: this.idAsignado,
          id_cargo: this.idCargo,
          tipo: this.tpVeh,
          id_linea: this.idMarcaVeh,
          modelo: this.modelo,
          cilindraje: this.cilindraje,
          traccion: this.traccion,
          combustible: this.tpCombs,
          color: this.color,
          km: this.km,
          rin: this.tpRin,
          nllantas: this.numLlantas,
          km_cambio: this.cambio,
          ref_aceite: this.aceite,
          fec_compra: this.fecCompra,
          desc: this.descripcion
        })
        .then(function(response) {
          // me.ocultarDetalle();
          me.listarVehiculo(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarNovedad(page, buscar) {
      let me = this;
      var url = "/noveh/?page=" + page + "&buscar=" + this.form.placa;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayNovedad = respuesta.noveh.data;
          me.pagination = respuesta.pagination;
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

    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    this.listarVehiculo(1, this.buscar, this.criterio);
    // this.listarNovedad(1, this.placa, "");

    // this.getNovedad();
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
.uploader {
  width: 100%;
  background: #60aae7;
  color: #fff;
  padding: 40px 15px;
  text-align: center;
  border-radius: 10px;
  border: 3px dashed #fff;
  font-size: 20px;
  position: relative;
}
.uploader:dragging {
  background: #fff;
  color: #2196f3;
  border: 3px dashed #2196f3;
}

i.fa.fa-cloud-upload {
  font-size: 58px;
}
.file-input {
  width: 200px;
  margin: auto;
  height: 68px;
  position: relative;
}
.file-input label {
  background: #fff;
  color: #2196f3;
  width: 105%;
  position: absolute;
  left: 0;
  top: 0;
  padding: 10px;
  border-radius: 4px;
  margin-top: 7px;
  cursor: pointer;
}

.file-input input {
  opacity: 0;
  z-index: -2;
}

.images-preview {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}

.img-wrapper {
  width: 160px;
  display: flex;
  flex-direction: column;
  margin: 10px;
  height: 150px;
  justify-content: space-between;
  background: #fff;
  box-shadow: 5px 5px 20px #3e3737;
}
img {
  max-height: 105px;
}
.details {
  font-size: 12px;
  background: #fff;
  color: #000;
  display: flex;
  flex-direction: column;
  align-items: self-start;
  padding: 3px 6px;
}
.name {
  overflow: hidden;
  height: 18px;
}

.upload-control {
  position: absolute;
  width: 100%;
  background: #fff;
  top: 0;
  left: 0;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
  padding: 10px;
  padding-bottom: 4px;
  text-align: right;
}
.upload-control button {
  background: #3ab458;
  border: 2px solid #3ab458;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
}
.upload-control label {
  background: #f5a528;
  border: 2px solid #f5a528;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
  padding: 2px 5px;
  margin-right: 10px;
}
.material-icons.Color1 {
  color: rgb(31, 33, 34);
}
.material-icons.Color2 {
  color: rgba(167, 142, 5, 0.849);
}
.material-icons.Color3 {
  color: rgb(12, 170, 91);
}
.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
</style>
