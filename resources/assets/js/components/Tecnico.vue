<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión de Técnicos
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="md-layout">
              <div class="md-layout-item">
                <md-field md-clearable>
                  <label>Qué desea Buscar</label>
                  <md-input v-model="buscar" @keypress="listarPersona(1,buscar)"></md-input>
                </md-field>
              </div>&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <br />
                <md-button
                  class="md-icon-button md-dense md-raised md-primary"
                  @click="listarPersona(1,buscar)"
                >
                  <md-icon>search</md-icon>
                </md-button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayPersona" :key="objeto.id">
                    <td v-text="objeto.nombreFull"></td>
                    <td v-text="objeto.num_doc"></td>
                    <td v-text="objeto.direccion"></td>
                    <td v-text="objeto.telefono"></td>
                    <td v-text="objeto.email"></td>
                    <td v-text="objeto.nomcargo"></td>
                    <td>
                      <md-button
                        class="md-icon-button"
                        @click="mostrarActualizar(objeto)"
                        title="Actualizar"
                      >
                        <i class="material-icons Color3">edit</i>
                      </md-button>
                      <md-button
                        class="md-icon-button md-primary"
                        @click="eliminarEstacion(objeto)"
                        title="Eliminar"
                      >
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
          </div>
        </template>
        <template v-else-if="listado==0">
          <div class="card-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <div class="md-layout">
                  <div class="md-layout-item md-size-25">
                    <md-field md-clearable>
                      <label>Tipo de identificación</label>
                      <md-select v-model="tpDoc" md-dense>
                        <md-option
                          v-for="objeto in arrayTpDoc"
                          :key="objeto.id"
                          :value="objeto.id"
                        >{{objeto.name}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-30">
                    <md-field md-clearable :class="getValidationClass('cedula')">
                      <label for="first-cc">Número de identificación</label>
                      <md-input
                        class="md-body-2"
                        type="number"
                        name="first-cc"
                        id="first-cc"
                        autocomplete="given-name"
                        v-model="form.cedula"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.cedula.required"
                      >Olvidaste ingresar el número de documento</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-30">
                    <md-field md-clearable :class="getValidationClass('nui')">
                      <label for="first-cc">NUI</label>
                      <md-input
                        class="md-body-2"
                        type="number"
                        name="first-cc"
                        id="first-cc"
                        autocomplete="given-name"
                        v-model="form.nui"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nui.required"
                      >Olvidaste ingresar el NUI</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-25">
                    <md-field md-clearable :class="getValidationClass('nombres')">
                      <label for="first-name">Nombres</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nombres"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nombres.required"
                      >Es necesario ingresar un Nombre</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-25">
                    <md-field md-clearable :class="getValidationClass('apellidos')">
                      <label for="first-ape">Apellidos</label>
                      <md-input
                        name="first-ape"
                        id="first-ape"
                        autocomplete="given-name"
                        v-model="form.apellidos"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.apellidos.required"
                      >Es necesario ingresar un Apellido</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-22">
                    <md-field md-clearable>
                      <label>Celular</label>
                      <span class="md-prefix">
                        <i class="material-icons">phone_iphone</i>
                      </span>
                      <md-input v-model="telefono" md-counter="10" maxlength="10"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Género</label>
                      <md-select v-model="genero" md-dense>
                        <md-option
                          v-for="objeto in arrayGenero"
                          :key="objeto.id"
                          :value="objeto.id"
                        >{{objeto.name}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
                </div>

                <div class="md-layout">
                  <!-- <div class="md-layout-item md-size-21" v-show="mostrarC==1">
                    <span>Seleccione un Departamento</span>
                    <v-select
                      :on-search="selectDpto"
                      label="nombre"
                      :options="arrayDpto"
                      placeholder="Buscar Departamentos..."
                      :onChange="getDatosDpto"
                    ></v-select>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-28" v-show="mostrarC==1">
                    <span>Seleccione una Ciudad</span>
                    <v-select
                      :on-search="selectMpio"
                      label="nombre"
                      :options="arrayMpio"
                      placeholder="Buscar Ciudad..."
                      :onChange="getDatosDpto"
                    ></v-select>
                  </div> -->
&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item" v-show="mostrarC==1">
                    <md-field>
                      <label>Departamento</label>
                      <md-select v-model="idDpto" md-dense @input="getMpio">
                        <md-option
                          v-for="(dpto, index)  in arrayDpto"
                          :key="`dpto-${index}`"
                          :value="dpto.id"
                        >{{dpto.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item md-size-25" v-show="mostrarC==1">
                    <md-autocomplete
                      md-dense
                      v-model="idMp"
                      :md-options="arrayMpio.map(x=>({
                      'id':x.id,
                      'nombre':x.nombre,
                      'toLowerCase':()=>x.nombre.toLowerCase(),
                      'toString':()=>x.nombre
                      }))"
                      @md-changed="getMpio"
                      @md-opened="getMpio"
                    >
                      <label>Municipio</label>
                      <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.nombre }}</template>
                    </md-autocomplete>
                  </div>-->
                  <div class="md-layout-item" v-show="mostrarC==1">
                    <md-field md-clearable>
                      <label>Municipio</label>
                      <md-select v-model="idMp" md-dense>
                        <md-option
                          v-for="(mpio,index) in arrayMpio"
                          :key="`mpio-${index}`"
                          :value="mpio.id"
                        >{{mpio.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Dirección</label>
                      <span class="md-prefix">
                        <i class="material-icons">house</i>
                      </span>
                      <md-input v-model="direccion"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-25">
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
                  <div class="md-layout-item md-size-25">
                    <md-field md-clearable>
                      <label>Cargo</label>
                      <md-select v-model="idCargo" md-dense>
                        <md-option
                          v-for="cargo in arrayCargo"
                          :key="cargo.id"
                          :value="cargo.id"
                        >{{cargo.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('email')">
                      <label>E-mail</label>
                      <span class="md-prefix">
                        <i class="material-icons">email</i>
                      </span>
                      <md-input v-model="form.email" md-counter="80"></md-input>
                      <span class="md-error" v-if="!$v.form.email.email">Email incorrecto</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('email2')">
                      <label>Confirmar e-mail</label>
                      <span class="md-prefix">
                        <i class="material-icons">email</i>
                      </span>
                      <md-input v-model="form.email2" md-counter="80"></md-input>
                      <!-- <span class="md-error" v-if="!$v.form.email2.sameAsemail2">Email incorrecto</span> -->
                      <span
                        class="md-error"
                        v-if="!$v.form.email2.sameAsemail2"
                      >El e-mail NO coincide</span>
                    </md-field>
                  </div>
                  <div class="md-layout-item">
                    <md-datepicker
                      v-model="fecNac"
                      value="fecNac"
                      @input="toString"
                      md-immediately
                      :md-model-type="String"
                    >
                      <label>Fecha de Cumpleaños</label>
                    </md-datepicker>
                  </div>
                </div>
                <div class="md-layout">
                  <md-field>
                    <label>Observación</label>
                    <md-textarea v-model="observacion"></md-textarea>
                  </md-field>
                </div>
              </md-card-content>
            </form>
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
                @click="validarDatos2()"
              >Actualizar</md-button>
            </md-card-actions>
          </div>
        </template>
      </div>

      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->

    <!-- /.modal-dialog -->

    <!--Fin del modal-->
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
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdDatepicker);
Vue.use(MdList);
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";
import vSelect from "vue-select";
export default {
  mixins: [validationMixin],

  data() {
    return {
      form: {
        cedula: "",
        nui: "",
        nombres: "",
        apellidos: "",
        email: "",
        email2: ""
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idTpEstacion: 0,
      idDpto: "",
      idMp: "",
      idArea: "",
      idCargo: "",
      estacion_id: 0,
      tpDoc: "CC",
      genero: "",
      telefono: "",
      direccion: "",
      observacion: "",
      mostrarC: "",
      arrayArea: [],
      arrayCargo: [],

      fecNac: "",
      // Genero M-F
      arrayGenero: [
        { id: "M", name: "Masculino" },
        { id: "F", name: "Femenimo" }
      ],
      // Tipo Documento
      arrayTpDoc: [
        { id: "CC", name: "Cedula de Ciudadania" },
        { id: "RC", name: "Registro Civil" },
        { id: "TI", name: "Tarjeta de Identidad" },
        { id: "PS", name: "Pasaporte" }
      ],
      arrayDpto: [],
      arrayMpio: [],
      arrayPersona: [],
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
      criterio: "nombre",
      buscar: ""
    };
  },

  components: {
    vSelect
  },
  validations: {
    form: {
      cedula: {
        required
      },
       nui: {
        required
      },
      nombres: {
        required
      },
      apellidos: {
        required
      },
      email: {
        email
      },
      email2: {
        sameAsemail2: sameAs("email")
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
        this.registrarPersona();
        this.clearForm();
      }
    },
    validarDatos2() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.actualizarPersona();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombres = "";
      this.form.apellidos = "";
      this.form.cedula = "";
      this.telefono = "";
      this.genero = "";
      this.idDpto = "";
      this.idMp = "";
      this.direccion = "";
      this.form.email = "";
      this.form.email2 = "";
      this.fecNac = "";
      this.observacion = "";
    },
    getDatosDpto(val1) {
      let me = this;
      me.loading = true;
      me.idDpto = val1.id;
    },
    selectDpto(search, loading) {
      let me = this;
      loading(true);

      var url = "/dpto/selectDptoCbx?filtro=" + search;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          q: search;
          me.arrayDpto = respuesta.dpto;
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
    selectMpio(search, loading) {
      let me = this;
      loading(true);

      var url = "/dpto/selectDptoCbx?filtro=" + search;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          q: search;
          me.arrayDpto = respuesta.dpto;
          loading(false);
        })
        .catch(function(error) {
          console.log(error);
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
      var url = "/mpio/selectMpio/?buscar=" + this.idDpto;
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
    getMpio2() {
      let me = this;
      var url = "/mpio/selectMpio/?buscar=" + this.idDpto;
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
      var url = "/tecnico?page=" + page + "&buscar=" + buscar;
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

    mostrarDetalle() {
      this.clearForm();
      let me = this;
      me.mostrarC = 1;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarEstacion(page, buscar, criterio) {
      let me = this;
      var url =
        "/estacion?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEstacion = respuesta.estacion.data;
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
      me.listarPersona(page, buscar, criterio);
    },
    mostrarActualizar(data = []) {
      let me = this;
      this.mostrarC = 2;
      (this.tipoAccion = 2), (me.listado = 0);
      this.form.cedula = data["num_Doc"];
      this.form.nombres = data["nombres"];
      this.form.apellidos = data["apellidos"];
      this.tp_doc = data["tp_doc"];
      this.form.cedula = data["id"];
      this.idArea = data["idArea"];
      
      this.getCargo();
      
      this.idCargo = data["idcargo"];
      this.direccion = data["direccion"];
      this.observacion = data["observacion"];
      this.genero = data["genero"];
      this.fecNac = data["fec_nac"];
      this.telefono = data["telefono"];
      this.form.email = data["email"];
      this.form.email2 = data["email"];
    },
    registrarPersona() {
      let me = this;

      axios
        .post("/cliente/registrarT", {
          id: this.form.cedula,
          nui: this.form.nui,
          nombres: this.form.nombres.toUpperCase(),
          apellidos: this.form.apellidos.toUpperCase(),
          tp_doc: this.tpDoc,
          genero: this.genero,
          fec_nac: this.fecNac,
          id_mpio: this.idMp,
          id_cargo: this.idCargo,
          direccion: this.direccion,
          observacion: this.observacion.toUpperCase(),
          telefono: this.telefono,
          is_empleado: "1",
          email: this.form.email
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarPersona(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarPersona() {
      let me = this;

      axios
        .put("/cliente/actualizar", {
          id: this.form.cedula,
          nombres: this.form.nombres.toUpperCase(),
          apellidos: this.form.apellidos.toUpperCase(),
          tp_doc: this.tpDoc,
          genero: this.genero,
          fec_nac: this.fecNac,
          id_mpio: this.idMp,
          id_cargo: this.idCargo,
          direccion: this.direccion,
          observacion: this.observacion.toUpperCase(),
          telefono: this.telefono,
          email: this.form.email
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarPersona(1, "", "nombre");
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
              me.listarEstacion(1, "", "nombre");
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
    this.getDpto();
    this.getArea();
    this.listarPersona(1, this.buscar);
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
  color: rgb(12, 170, 91);
}
.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
</style>
