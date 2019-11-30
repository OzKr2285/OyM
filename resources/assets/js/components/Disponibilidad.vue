<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión de Disponibilidades
          <!-- <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button> -->
        </div>
        <template v-if="listado == 1">
          <div class="card-body">
            <div class="md-layout">
              <div class="md-layout-item">
                <md-field md-clearable>
                  <label>Qué desea Buscar</label>
                  <md-input
                    v-model="buscar"
                    @keypress="listarDatos(page, buscar, criterio)"
                  ></md-input>
                </md-field>
              </div>
              &nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <br />
                <md-button
                  class="md-icon-button md-dense md-raised md-primary"
                  @click="listarDatos(page, buscar, criterio)"
                >
                  <md-icon>search</md-icon>
                </md-button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>Ticket</th>
                    <th>Prioridad</th>
                    <th>Fecha</th>
                    <!-- <th>Técnico</th> -->
                    <!-- <th>Usuario</th>
                    <th>Dirección</th>
                    <th>Municipio</th>
                    <th>Telefono</th> -->
                    <th>Servicio</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(objeto, index) in arrayDatos"
                    :key="`objeto-${index}`"
                  >
                    <td v-text="objeto.idticket"></td>
                    <td>
                      <template v-if="objeto.prioridad == 'N'">
                        <span class="badge badge-success">Normal</span>
                      </template>
                      <template v-if="objeto.prioridad == 'M'">
                        <span class="badge badge-warning">Media</span>
                      </template>
                      <template else v-if="objeto.prioridad == 'A'">
                        <span class="badge badge-danger">Alta</span>
                      </template>
                    </td>
                    <td v-text="objeto.fecha"></td>
                    <!-- <td v-text="objeto.tecnico"></td> -->
                    <!-- <td v-text="objeto.nombreFull"></td>
                    <td v-text="objeto.direccion"></td>
                    <td v-text="objeto.mpio"></td>
                    <td v-text="objeto.telefono"></td> -->
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.desc"></td>

                    <td>
                      <template v-if="objeto.edo == 0">
                        <span class="badge badge-primary">Asignado</span>
                      </template>
                      <template v-if="objeto.edo == 1">
                        <span class="badge badge-warning">En Ejecución</span>
                      </template>
                      <template v-if="objeto.edo == 5">
                        <span class="badge badge-success">Finalizado</span>
                      </template>
                      <template else v-if="objeto.edo == 3">
                        <span class="badge badge-dark">Aprobado</span>
                      </template>
                    </td> 
                    <td>
                      <md-button  
                        class="md-icon-button"
                        @click="mostrarActualizar(objeto)"
                        title="Revisar Servicio"
                      >
                        <i class="material-icons Color3">insert_drive_file</i>
                      </md-button>
                      <template v-if="objeto.edo != 3">
                        <md-button
                          class="md-icon-button md-primary"
                          @click="setDisp(objeto)"
                          title="Finalizar Actividad"
                        >
                          <i class="material-icons Color4">verified_user</i>
                        </md-button>
                      </template>
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
                    @click.prevent="
                      cambiarPagina(
                        pagination.current_page - 1,
                        buscar,
                        criterio
                      )
                    "
                    >Ant</a
                  >
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
                    @click.prevent="cambiarPagina(page, buscar, criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li
                  class="page-item"
                  v-if="pagination.current_page < pagination.last_page"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPagina(
                        pagination.current_page + 1,
                        buscar,
                        criterio
                      )
                    "
                    >Sig</a
                  >
                </li>
              </ul>
            </nav>
          </div>
        </template>
        <template v-else-if="listado == 0">
          <div class="card-body">
            <form
              action
              method="post"
              enctype="multipart/form-data"
              class="form-horizontal"
            >
              <md-card-content>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field>
                      <label for="first-name">Categoria</label>
                      <md-input
                        class="md-body-2"
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="CatServ"
                        disabled
                      />

                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>
                  &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label for="first-name">Objetivo del Servicio</label>
                      <md-input
                        class="md-body-2"
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="ObjetoServ"
                        disabled
                      />

                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>
                </div>

                <div class="md-layout">
                  <md-field>
                    <label>Descripción suministrada por el usuario</label>
                    <md-textarea v-model="observacion" disabled></md-textarea>
                  </md-field>
                </div>
                <div class="md-layout">
                  <!-- <md-button class="md-fab-bottom-left md-mini" @click="abrirModal5()">
                    <md-icon>group_add</md-icon>
                  </md-button>-->
                </div>

                <span class="md-caption">Actividades Realizadas</span>
                <div class="md-layout"></div>
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Actividad a Realizar</th>
                        <th>Descripción</th>
                        <th>Opciones</th>
                      </tr>
                      <md-button class="md-icon-button md-primary" @click="abrirModal5">
                        <md-icon>post_add</md-icon>
                      </md-button>
                    </thead>
                    <tbody v-if="arrayDetAct.length">
                      <tr
                        v-for="(objeto, index) in arrayDetAct"
                        :key="`objeto-${index}`"
                      >
                        <td v-text="objeto.nombre"></td>
                        <td v-text="objeto.desc"></td>
                        <td>
                      <template v-if="objeto.edo == 0">
                        <md-button
                          class="md-icon-button md-primary"
                          @click="setDisp(objeto)"
                          title="Finalizar Actividad"
                        >
                          <i class="material-icons Color4">verified_user</i>
                        </md-button>
                      </template>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">
                          NO hay Actividades asignadas al servicio
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item ">
                    <md-switch v-model="ER">Existe Red</md-switch>
                  </div>
                  <div class="md-layout-item ">
                    <md-switch v-model="EA">Existe Acometida</md-switch>
                  </div>
                  <div class="md-layout-item ">
                    <md-switch v-model="EI">Existe Inst. Interna</md-switch>
                  </div>
                  <div class="md-layout-item ">
                    <md-switch v-model="A">Apta</md-switch>
                  </div>
                  <div class="md-layout-item ">
                    <md-switch v-model="REE"
                      >Requiere Elementos Especiales</md-switch
                    >
                  </div>
                  <div class="md-layout-item ">
                    <md-switch v-model="ROE"
                      >Requiere Obras Especiales</md-switch
                    >
                  </div>

                  <div class="md-layout-item md-size-10">
                    <md-field>
                      <label for="first-name">Dist. mts Red</label>
                      <md-input
                        class="md-body-2"
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="distMts"
                      />

                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">                    
                    <span class="md-body-1">Material Excavar</span>
                    <md-checkbox v-model="demo" value="AT">AT</md-checkbox>
                    <md-checkbox v-model="demo" value="AC">AC</md-checkbox>
                    <md-checkbox v-model="demo" value="AE">AE</md-checkbox>
                    <md-checkbox v-model="demo" value="VT">VT</md-checkbox>
                    <md-checkbox v-model="demo" value="VC">VC</md-checkbox>
                    <md-checkbox v-model="demo" value="VA">VA</md-checkbox>
                  </div>
                </div>
                <div class="md-layout">
                  <md-field>
                    <label>Descripción suministrada por el Técnico</label>
                    <md-textarea v-model="obsTec" ></md-textarea>
                    <md-icon>description</md-icon>
                  </md-field>
                </div>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button
                type="button"
                class="md-raised"
                @click="ocultarDetalle()"
                >Cerrar</md-button
              >
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion == 1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="validarDatos()"
                >Guardar</md-button
              >
              <md-button
                type="submit"
                v-if="tipoAccion == 2"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="actualizarEstacion()"
                >Actualizar</md-button
              >
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
      :class="{ mostrar: modal5 }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button
              type="button"
              class="close"
              @click="cerrarModal5()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-9">
                <div class="input-group">
                  <select
                    class="form-control col-md-4"
                    v-model="idCatServ"
                    @change="getServicio(1, this.idCatServ, this.criterio)"
                  >
                    <option
                      v-for="objeto in arrayCatServ"
                      :key="objeto.id"
                      :value="objeto.id"
                      >{{ objeto.nombre }}</option
                    >
                  </select>

                  <button
                    type="submit"
                    @click="getServicio(1, this.idCatServ, this.criterio)"
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
                    <th>Servicio</th>
                    <th>Descripción</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayServicio.length">
                  <tr
                    v-for="(objeto, index) in arrayServicio"
                    :key="`objeto-${index}`"
                  >
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.desc"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarServ(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Servicios registrados.</td>
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
                    @click.prevent="
                      cambiarPaginaTec(
                        pagination.current_page - 1,
                        buscar,
                        criterio
                      )
                    "
                    >Ant</a
                  >
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
                    @click.prevent="cambiarPaginaTec(page, buscar, criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li
                  class="page-item"
                  v-if="pagination.current_page < pagination.last_page"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPaginaTec(
                        pagination.current_page + 1,
                        buscar,
                        criterio
                      )
                    "
                    >Sig</a
                  >
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModal5()"
            >
              Cerrar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{ mostrar: modal2 }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button
              type="button"
              class="close"
              @click="cerrarModal2()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <v-select
                    v-model="idCategoria"
                    :options="arrayCategoria"
                  ></v-select>

                  <button
                    type="submit"
                    @click="getPerso(1, buscar, this.criterio)"
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
                    <th>Documento</th>
                    <th>Nombre Técnico</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayPerso.length">
                  <tr
                    v-for="(objeto, index) in arrayPerso"
                    :key="`objeto-${index}`"
                  >
                    <td v-text="objeto.id"></td>
                    <td v-text="objeto.nombreFull"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarTecnico(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Tecnicos asignados.</td>
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
                    @click.prevent="
                      cambiarPaginaTec(
                        pagination.current_page - 1,
                        buscar,
                        criterio
                      )
                    "
                    >Ant</a
                  >
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
                    @click.prevent="cambiarPaginaTec(page, buscar, criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li
                  class="page-item"
                  v-if="pagination.current_page < pagination.last_page"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPaginaTec(
                        pagination.current_page + 1,
                        buscar,
                        criterio
                      )
                    "
                    >Sig</a
                  >
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModal2()"
            >
              Cerrar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
    <!-- /.modal-dialog -->
 
  </main>
</template>

<script>
import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdDatepicker,
  MdCheckbox,
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
import vSelect from "vue-select";

Vue.component("v-select", vSelect);
Vue.use(MdButton);
Vue.use(MdCheckbox);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdDatepicker);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  data() {
    return {
      form: {
        cedula: "",
        nombres: "",
        apellidos: "",
        email: "",
        email2: ""
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idTicketServ: 0,
      idCatServ: 0,
      idUsuario: 0,
      idTec: 0,
      idCategoria: 0,
      idObjeto: 0,
      ER: false,
      EA: false,
      EI: false,
      A: false,
      REE: false,
      REE: false,
      ROE: false,
      CatServ: "",
      distMts: "",
      ObjetoServ: "",
      idPrioridad: "N",
      idMedio: "T",
      tpDoc: "CC",
      genero: "",
      telefono: "",
      direccion: "",
      observacion: "",
      obsTec: "",
      mostrarC: 1,
      modal5: 0,
      modal2: 0,
    

      fecNac: "",
      // Genero M-F
      arrayPrioridad: [
        { id: "N", name: "Normal" },
        { id: "A", name: "Alta" },
        { id: "MA", name: "Muy Alta" }
      ],
      // Tipo Documento
      arrayMedio: [
        { id: "T", name: "Telefónico" },
        { id: "I", name: "Internet" },
        { id: "P", name: "Personal" },
        { id: "TC", name: "Técnico" }
      ],
      arrayDatos: [],      
      arrayDetAct: [],
      arrayPerso: [],
      arrayPersona: [],
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      arrayTec: [],
      arrayServ: [],
      arrayCategoria: [],
      arrayObjeto: [],
      arrayCatServ: [],
      arrayServicio: [],

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

  validations: {
    form: {
      // cedula: {
      //   required
      // }
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
    }
  },
  methods: {
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
        this.setDisp(1);
        this.registrarTicket();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
    },
    abrirModal2() {
      // this.idRefE=data["idref"];
      this.modal2 = 1;
      this.tituloModal = "Seleccione uno o varios Técnicos";
      this.getPerso(1, this.buscar, this.criterio);
    },
    cerrarModal2() {
      this.modal2 = 0;
      this.tituloModal = "";
    },
    abrirModal5() {
      // this.idRefE=data["idref"];
      this.getCatServ();
      this.modal5 = 1;
      this.tituloModal = "Seleccione una o varios Servicios";
      // this.getPerso(1, this.buscar, this.criterio);
    },
    cerrarModal5() {
      this.modal5 = 0;
      this.tituloModal = "";
    },
    
    getCategoria() {
      let me = this;

      var url = "/categoria/selectCategoria";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayCategoria = respuesta.categorias;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getCatServ() {
      let me = this;

      var url = "/catserv/selectCategoria";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayCatServ = respuesta.categorias;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getObjeto() {
      let me = this;

      var url = "/objpqrs/selectCat?buscar=" + this.idCategoria;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayObjeto = respuesta.objeto;
          if (me.arrayObjeto.length < 0) {
            me.arrayObjeto[0]["No Existen Registros"];
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getDetAct() {
      let me = this;

      var url = "/actserv?buscar=" + this.idTicketServ;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);;
          var respuesta = response.data;
          me.arrayDetAct = respuesta.detact.data;
          me.pagination = respuesta.pagination;

        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getServicio(page, buscar, criterio) {
      let me = this;

      var url =
        "/servicio/getservicio?page=" + page + "&buscar=" + me.idCatServ;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayServicio = respuesta.servicio.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getPerso(page, buscar, criterio) {
      let me = this;

      var url = "/persona/selectTecnico?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayPerso = respuesta.perso.data;
          me.pagination = respuesta.pagination;
          // if (me.arrayPerso.length>0){
          //           this.form.nombres=me.arrayPerso[1]['nombreFull'];

          //       }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getUsuario(buscar) {
      let me = this;

      var url = "/persona/getusuario?buscar=" + me.form.cedula;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayPerso = respuesta.perso;
          if (me.arrayPerso.length > 0) {
            me.form.nombres = me.arrayPerso[0]["nombres"];
            me.form.apellidos = me.arrayPerso[0]["apellidos"];
            me.direccion = me.arrayPerso[0]["direccion"];
            me.telefono = me.arrayPerso[0]["telefono"];
            me.form.email = me.arrayPerso[0]["email"];
            me.idUsuario = me.arrayPerso[0]["num_doc"];
          } else {
            me.form.nombres = "Usuario no Existe";
            me.form.apellidos = "";
            me.direccion = "";
            me.telefono = "";
            me.form.email = "";
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    agregarTecnico(data = []) {
      let me = this;
      if (me.encuentra5(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "El Técnico seleccionado ya se encuentra agregado!"
        });
      } else {
        me.arrayTec.push({
          id: data["id"],
          nombre: data["nombreFull"],
          Rol: 0
        });
      }
    },
    encuentra5(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayTec.length; i++) {
        if (this.arrayTec[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarServ(data = []) {
      let me = this;
      if (me.encuentra4(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Actividad seleccionada ya se encuentra agregada!"
        });
      } else {
        me.arrayDetAct.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"],
          edo: "0",
          new: "1"
        });
      }
    },
    encuentra4(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayServ.length; i++) {
        if (this.arrayServ[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    setTecnico(id) {
      swal({
        title: "Esta seguro de Asignar al Técnico como Responsable?",
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

          me.arrayTec[id].Rol = 1;
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    unsetTecnico(id) {
      swal({
        title: "Esta seguro de Asignar al Técnico como Auxiliar?",
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

          me.arrayTec[id].Rol = 0;
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    setDisp(id) {
      swal({
        title: "Esta seguro de Aprobar la Disponibilidad?",
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

          me.arrayTec[id].Rol = 0;
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    getDpto() {
      let me = this;

      var url = "/dpto/selectDpto";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayDpto = respuesta.dpto;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getMpio() {
      let me = this;
      var url = "/mpio/selectMpio/?buscar=" + this.idDpto.id;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMpio = respuesta.mpio;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarPersona(page, buscar) {
      let me = this;
      var url = "/cliente?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayPersona = respuesta.personas.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getTpEstacion() {
      let me = this;

      var url = "/tpestacion/selectTpEstacion";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTpEstacion = respuesta.tpestacion;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      (me.idTicketServ = data["idticket"]),
      this.CatServ = data["nomCat"];
      this.ObjetoServ = data["nombre"];
      this.observacion = data["desc"];
      this.getDetAct();
      // this.form.descripcion = data["descripcion"];
    },
    mostrarDatos(data = []) {
      // revisar objeto valores no llega data
      let me = this;
      this.form.nombres = data["nombreFull"];
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarDatos(page, buscar, criterio) {
      let me = this;
      var url =
        "/ticketserv/getDispo?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDatos = respuesta.ticket.data;
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
      me.listarDatos(page, buscar, criterio);
    },
    registrarTicket() {
      let me = this;

      axios
        .post("/ticketserv/registrar", {
          id_usuario: this.idUsuario,
          id_objpqrs: this.idObjeto,
          medio: this.idMedio,
          prioridad: this.idPrioridad,
          desc: this.observacion.toUpperCase(),
          data: this.arrayTec,
          data2: this.arrayServ
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarDatos(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarEstacion() {
      let me = this;

      axios
        .put("/estacion/actualizar", {
          idTicketServ: this.idTicketServ,
          nombre: this.form.nombre.toUpperCase(),
          descripcion: this.form.descripcion.toUpperCase(),
          id: this.estacion_id
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarDatos(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarEstacion(data = []) {
      swal({
        title: "Esta seguro de Eliminar la Estación " + data["nombre"],
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
          this.estacion_id = data["id"];
          axios
            .post("/estacion/eliminar", {
              id: this.estacion_id
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarDatos(1, "", "nombre");
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
    this.getCategoria();
    this.listarDatos(1, this.buscar, this.criterio);
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
.material-icons.Color1 {
  color: rgb(31, 33, 34);
}
.material-icons.Color2 {
  color: rgba(167, 142, 5, 0.849);
}
.material-icons.Color3 {
  color: rgb(38, 136, 167);
}
.material-icons.Color4 {
  color: rgba(67, 185, 72, 0.863);
}
.md-dialog {
  max-width: 768px;
}
</style>
