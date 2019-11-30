<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Accesorios..
          <button
            type="button"
            @click="abrirModal('accesorio','registrar')"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criterio">
                  <option value="nombre">Nombre</option>
                  <option value="descripcion">Descripción</option>
                </select>
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarAccesorio(1,buscar,criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                >
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
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr class="p-3 mb-2 bg-dark text-white">
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Modelo</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="accesorio in arrayAccesorio" :key="accesorio.id">
                <td v-text="accesorio.nombre"></td>
                <td v-text="accesorio.desc"></td>
                <td v-text="accesorio.modelo"></td>

                <td>
                  <button
                    type="button"
                    @click="abrirModal('accesorio','actualizar',accesorio)"
                    class="btn btn-warning btn-sm"
                    data-tooltip
                    title="Actualizar"
                  >
                    <i class="icon-pencil"></i>
                  </button>
                  &nbsp;
                  <button
                    type="button"
                    class="btn btn-danger btn-sm"
                    data-tooltip
                    title="Eliminar"
                    @click="eliminarAccesorio(accesorio)"
                  >
                    <i class="icon-trash"></i>
                  </button>
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
      id="demo"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <div class="md-layout">
                  <div class="md-layout-item md-size-60">
                    <md-field :class="getValidationClass('nombre')">
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
                      >El nombre del Accesorio es requerido</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-25">
                    <md-field >
                      <label for="m">modelo</label>
                      <md-input
                        v-model="modelo"                  
                      />            
                    </md-field>
                  </div>
                </div>
                <md-field :class="getValidationClass('descripcion')">
                  <label for="desc-name">Descripción</label>
                  <md-input
                    name="desc-name"
                    id="desc-name"
                    autocomplete="given-name"
                    v-model="form.descripcion"
                    :disabled="sending"
                  />
                  <span class="md-error" v-if="!$v.form.descripcion.required">Ingrese la descripción</span>
                  <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                </md-field>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="cerrarModal()">Cerrar</md-button>
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="validarDatos()"
              >Guardar</md-button>
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==2"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="actualizarAccesorio()"
              >Actualizar</md-button>
            </md-card-actions>
   
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdField,
  MdIcon,
  MdCard,
  MdDialog
} from "vue-material/dist/components";

Vue.use(MdButton);
Vue.use(MdCard);
Vue.use(MdIcon);
Vue.use(MdContent);
Vue.use(MdDialog);
Vue.use(MdField);

import { required, minLength } from "vuelidate/lib/validators";

export default {
  name: "FormValidation",
  mixins: [validationMixin],

  data() {
    return {
      userSaved: false,
      sending: false,

      sending: false,
      id_accesorio: 0,
      modelo: "No Aplica",
      modal: 0,
      form: {
        nombre: "",
        descripcion: ""
      },

      arrayAccesorio: [],
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

  validations: {
    form: {
      nombre: {
        required
      },
      descripcion: {
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
        this.registrarAccesorio();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
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
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarAccesorio(page, buscar, criterio);
    },
    registrarAccesorio() {
      let me = this;

      axios
        .post("/accesorio/registrar", {
          nombre: this.form.nombre.toUpperCase(),
          descripcion: this.form.descripcion.toUpperCase(),
          modelo: this.modelo
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarAccesorio(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarAccesorio() {
      let me = this;

      axios
        .put("/accesorio/actualizar", {
          nombre: this.form.nombre.toUpperCase(),
          descripcion: this.form.descripcion.toUpperCase(),
          modelo: this.modelo,
          id: this.id_accesorio
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarAccesorio(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarAccesorio(data = []) {
      swal({
        title: "Esta seguro de Eliminar este Accesorio " + data["nombre"],
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
          this.id_accesorio = data["id"];
          axios
            .post("/accesorio/eliminar", {
              id: this.id_accesorio
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
    },
  ocultarDetalle() {
      this.listado = 1;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.clearForm();
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case "accesorio": {
          switch (accion) {
            case "registrar": {
              this.modal = 1;
              this.tituloModal = "Registrar Accesorio";
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              //console.log(data);
              this.modal = 1;
              this.tituloModal = "Actualizar Accesorio";
              this.tipoAccion = 2;
              this.id_accesorio = data["id"];
              this.form.nombre = data["nombre"];
              this.form.descripcion = data["desc"];
              this.modelo = data["modelo"];
              break;
            }
          }
        }
      }
    }
  },

  mounted() {
    this.listarAccesorio(1, this.buscar, this.criterio);
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
</style>
