<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión Ciclos
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
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">                 
                    <th>Ciclo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayMain" :key="objeto.id">
                    <td v-text="objeto.nomM"></td>                    
                    <td>
                      <md-button class="md-icon-button " @click="mostrarActualizar(objeto)" title="Actualizar">                         
                      <i class="material-icons Color3">edit</i>
                    </md-button>
                    <md-button class="md-icon-button md-primary " @click="eliminarRefE(objeto)" title="Eliminar">
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
                <div class="md-layout-item md-size-45">
                  <md-field md-clearable>
                    <label>Seleccione el Mercado</label>
                    <md-select v-model="idCiclo" md-dense @input="listarDetalle(page, buscar, criterio)">
                      <md-option
                        v-for="objeto in arrayCiclo"
                        :key="objeto.id"
                        :value="objeto.id"
                      >{{objeto.nombre}}</md-option>
                    </md-select>
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
<!--                 
                <div class="md-layout-item">
                  <md-field md-clearable :class="getValidationClass('nombre')">
                    <label for="first-name">Nombre</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nombre"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nombre.required"
                    >Olvidaste ingresar el nombre del Mercado</span>
                    
                  </md-field>
                </div> -->
                </div>
                 <div>          
                <span class="md-caption">Detalle Mercado</span>
                  <md-button class="md-icon-button md-primary" @click="abrirModal5">
                    <md-icon>post_add</md-icon>
                    </md-button>
                </div>    
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Dpto</th>                        
                        <th>Municipio</th>                        
                        <th>Opciones</th>
                      </tr>
                      <!-- <md-button class="md-icon-button md-primary" @click="abrirModal5">
                        <md-icon>post_add</md-icon>
                      </md-button> -->
                    </thead>
                    <tbody v-if="arrayDetM.length">
                      <tr
                        v-for="(objeto, index) in arrayDetM"
                        :key="`objeto-${index}`"
                      >                        
                        <td v-text="objeto.nomDpto"></td>
                        <td v-text="objeto.nombre"></td>
                        <td>
                          <md-button class="md-icon-button md-primary " @click="eliminarMpio(objeto)" title="Eliminar">
                            <i class="material-icons Color4">delete</i>
                          </md-button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">
                          NO hay Municipios asociados al Ciclo
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
                @click="actualizarM()"
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
                    v-model="idDpto"
                    @change="listarMpios(1, this.idDpto,criterio )"
                  >
                    <option
                      v-for="objeto in arrayDptos"
                      :key="objeto.id"
                      :value="objeto.id"
                      >{{ objeto.nombre }}</option
                    >
                  </select>
                  <input
                    type="text"
                    v-model="criterio"
                    @keypress="listarMpios(1,this.idDpto,criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarMpios(1, this.idDpto,criterio)"
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
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayMpios.length">
                  <tr
                    v-for="(objeto, index) in arrayMpios"
                    :key="`objeto-${index}`"
                  >
                    <td v-text="objeto.nomDpto"></td>
                    <td v-text="objeto.nombre"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarMpio(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Municipios registrados.</td>
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
                      cambiarPaginaM(
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
                    @click.prevent="cambiarPaginaM(page, buscar, criterio)"
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
                      cambiarPaginaM(
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
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  data() {
    return {
      form: {
        nombre: ""
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idCiclo: 0,
      cant: 0,
      undMed: 0,
      costo: 0,
      precio: 0,
      idRefM: 0,
      idMpio: "",
      idDpto: "",
      idDet: "",
      modal5: 0,

      arrayMain: [],
      arrayCiclo: [],
      arrayMpios: [],
      arrayDptos: [],
      arrayDetM: [],
      arrayDetMAct: [],
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
      criterio: "",
      buscar: ""
    };
  },

  validations: {
    form: {
      // nombre: {
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
        this.registrarM();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
    },
    abrirModal5() {
      // this.idRefE=data["idref"];
      this.getDpto();
      this.modal5 = 1;
      this.tituloModal = "Seleccione una o varios Municipios";
      // this.getPerso(1, this.buscar, this.criterio);
    },
    cerrarModal5() {
      this.modal5 = 0;
      this.tituloModal = "";
    },
    
    getCiclo() {
      let me = this;

      var url = "/mercado/selectMercado";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayCiclo = respuesta.mercado;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarMpios(page, buscar, criterio) {
      let me = this;
      var url =
        "/mpio/getMpios?page=" +
        page +
        "&buscar=" +
        this.idDpto +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMpios = respuesta.mpios.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    agregarMpio(data = []) {
      let me = this;
      if (me.encuentra3(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "El Municipio seleccionado ya se encuentra agregado!"
        });
      } else {
        me.arrayDetM.push({
          id: data["id"],
          nomDpto: data["nomDpto"],
          nombre: data["nombre"]
        });
          me.arrayDetMAct.push({
        id: data["id"],
          nomDpto: data["nomDpto"],
          nombre: data["nombre"]
        });
      }
    },
    encuentra3(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetM.length; i++) {
        if (this.arrayDetM[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
   
    mostrarActualizar(data = []) {
      let me = this;
      (this.idCiclo = data["id_mercado"]);      
      (this.tipoAccion = 2), (me.listado = 0);
      this.listarDetalle(this.page, this.buscar, this.criterio);
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarRefE(page, buscar, criterio) {
      let me = this;
      var url =
        "/detmercado?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMain = respuesta.refe.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetalle(page, buscar, criterio) {
      let me = this;
      var url =
        "/detmercado?page=" +
        page +
        "&buscar=" +
        this.idCiclo +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetM = respuesta.refe.data;
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
      me.listarRefE(page, buscar, criterio);
    },
    cambiarPaginaM(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarMpios(page, buscar,criterio);
    },
    getDpto() {
      let me = this;

      var url = "/dpto/selectDpto";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayDptos = respuesta.dpto;
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
          me.arrayMpios = respuesta.mpio;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    registrarM() {
      let me = this;

      axios
        .post("/detmercado/registrar", {
          idCiclo: this.idCiclo,   
          data: this.arrayDetM
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarRefE(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarM() {
      let me = this;

      axios
        .put("/detmercado/actualizar", {
          idCiclo: this.idCiclo,   
          data: this.arrayDetMAct
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarRefE(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarMpio(data = []) {
      swal({
        title: "Esta seguro de Eliminar el Municipio " + data["nombre"],
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
          this.idDet = data["id"];
          axios
            .post("/detmercado/eliminar", {
              id: this.idDet
            })
            .then(function(response) {
              me.ocultarDetalle();
              // me.listarRefE(1, "", "nombre");
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
    this.getCiclo();
    this.listarRefE(1, this.buscar, this.criterio);
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
.material-icons.Color2 { color: rgba(167, 142, 5, 0.849); }
.material-icons.Color3 { color: rgb(12, 170, 91); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
