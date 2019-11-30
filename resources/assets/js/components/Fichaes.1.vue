<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Tipo Estación
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
                    <th>Tipo Estacion</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="estacion in arrayEstacion" :key="estacion.id">
                    <td v-text="estacion.tpnombre"></td>
                    <td v-text="estacion.nombre"></td>
                    <td v-text="estacion.descripcion"></td>
                    <td>
                      <button
                        type="button"
                        @click="mostrarActualizar(estacion)"
                        class="btn btn-warning btn-sm"
                        data-tooltip
                        title="Actualizar"
                      >
                        <i class="icon-pencil"></i>
                      </button>
                      &nbsp;
                      <template>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-tooltip
                          title="Eliminar"
                          @click="eliminarEstacion(estacion)"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </template>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
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
          <div>
            <md-steppers :md-active-step.sync="active" md-linear>
              <md-step
                id="first"
                md-label="Información General"
                md-description="Optional"
                :md-done.sync="first"
              >
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
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
                  <div class="md-layout-item">
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
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Tipo de Estación</label>
                      <md-select v-model="idTpEstacion" md-dense @input="getEstacion">
                        <md-option
                          v-for="(tpestacion,index) in arrayTpEstacion"
                          :key="`tpestacion-${index}`"
                          :value="tpestacion.id"
                        >{{tpestacion.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Estación</label>
                      <md-select v-model="idEstacion" md-dense>
                        <md-option
                          v-for="(estacion,index) in arrayEstacion"
                          :key="`estacion-${index}`"
                          :value="estacion.id"
                        >{{estacion.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Etapa</label>
                      <md-select v-model="idEtapa" md-dense @input="getTrenEtapa">
                        <md-option
                          v-for="(etapa, index)  in arrayEtapa"
                          :key="`etapa-${index}`"
                          :value="etapa.id"
                        >{{etapa.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Tren Etapa</label>
                      <md-select v-model="idTrenEtapa" md-dense>
                        <md-option
                          v-for="(trenEtapa, index) in arrayTrenEtapa"
                          :key="`trenEtapa-${index}`"
                          :value="trenEtapa.id"
                        >{{trenEtapa.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>

                <md-button class="md-raised md-primary" @click="setDone('first', 'second')">Continue</md-button>
              </md-step>

              <md-step
                id="second"
                md-label="Información Administrativa"
                :md-error="secondStepError"
                :md-done.sync="second"
              >
                <div class="md-layout">
         
                  <div class="md-layout-item">
                    <span>Seleccione un Proveedor</span>
                    <v-select
                      :on-search="selectProveedor"
                      label="nombre"
                      :options="arrayProveedor"
                      placeholder="Buscar Proveedores..."
                      :onChange="getDatosProveedor"
                    ></v-select>
                  </div>&nbsp;&nbsp;&nbsp;&nbsp;
                           <div class="md-layout-item">
                    <md-field>
                      <label>Número de Factura</label>
                      <md-input autocomplete="given-name" v-model="numFact" :disabled="sending"/>
                    </md-field>
                  </div>
                </div>

                <div class="md-layout"></div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-datepicker v-model="fecCompra" md-immediately>
                      <label>Fecha de Compra</label>
                    </md-datepicker>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-datepicker v-model="fecGarantia" md-immediately>
                      <label>Fecha de Garantia</label>
                    </md-datepicker>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-datepicker v-model="fecInstala" md-immediately>
                      <label>Fecha de Instalación</label>
                    </md-datepicker>
                  </div>&nbsp;&nbsp;&nbsp;
         
                </div>
                         <div class="md-layout">
                    <md-field v-for="(prov) in arrayProveedor" :key="prov.id" :value="prov.id">
                      <label>
                        Contactar a
                        <b>{{prov.contacto}}</b> al número telefónico
                        <b>{{prov.telefono}}</b> o email
                        <b>{{prov.email}}</b>
                      </label>
                    </md-field>
                  </div>
                <md-button class="md-raised md-primary" @click="setDone('second', 'third')">Continue</md-button>
                <md-button class="md-raised md-primary" @click="setError()">Set error!</md-button>
              </md-step>

              <md-step id="third" md-label="Informacion Técnica" :md-done.sync="third">
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field>
                      <label>Nombre de Equipo</label>
                      <md-input autocomplete="given-name" v-model="nomEquipo" :disabled="sending"/>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label>Serial</label>
                      <md-input autocomplete="given-name" v-model="serial" :disabled="sending"/>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field>
                      <label>Modelo</label>
                      <md-input v-model="modelo" type="number"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Marca</label>
                      <md-select v-model="idMarca" md-dense @input="getMarca">
                        <md-option
                          v-for="(marca, index)  in arrayMarca"
                          :key="`marca-${index}`"
                          :value="marca.id"
                        >{{marca.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label>Rango Temperatura</label>
                      <md-input v-model="rgTemp" type="number"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label>Rango Presión</label>
                      <md-input v-model="rgPresion" type="number"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label>Rango Flujo</label>
                      <md-input v-model="rgFlujo" type="number"></md-input>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>

                <md-button class="md-raised md-primary" @click="setDone('third')">Done</md-button>

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
                      @click="actualizarEstacion()"
                    >Actualizar</md-button>
                  </md-card-actions>
                </div>
              </md-step>
            </md-steppers>
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
import format from "date-fns/format";

import vSelect from "vue-select";

import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdList,
  MdDatepicker,
  MdSteppers
} from "vue-material/dist/components";

Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdList);
Vue.use(MdDatepicker);
Vue.use(MdSteppers);

import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  data() {
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();
    return {
      active: "first",

      first: false,
      second: false,
      third: false,
      secondStepError: null,

      form: {
        nombre: "",
        descripcion: ""
      },

      tipoAccion: 1,

      listado: 1,
      sending: false,
      idTpEstacion: 0,
      idEstacion: 0,
      idDpto: 0,
      idMp: 0,
      idEtapa: 0,
      idTrenEtapa: 0,
      idproveedor: 0,
      idMarca: 0,
      numFact: "",
      nomEquipo: "",
      serial: "",
      modelo: "",
      fecCompra: "",
      fecGarantia: "",
      fecInstala: "",
      rgTemp: "",
      rgPresion: "",
      rgFlujo: "",

      arrayEstacion: [],
      arrayTpEstacion: [],
      arrayDpto: [],
      arrayMpio: [],
      arrayEtapa: [],
      arrayTrenEtapa: [],
      arrayProveedor: [],
      arrayMarca: [],
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
      nombre: {
        required
      },
      descripcion: {
        required
      }
    }
  },

  computed: {
    type() {
      if (
        typeof this.dynamicByModel === "object" &&
        this.dynamicByModel instanceof Date &&
        isValid(this.dynamicByModel)
      ) {
        return "date";
      } else if (typeof this.dynamicByModel === "string") {
        return "string";
      } else if (
        Number.isInteger(this.dynamicByModel) &&
        this.dynamicByModel >= 0
      ) {
        return "number";
      } else if (this.model === null || this.model === undefined) {
        return "null";
      } else {
        throw new Error("Type error");
      }
    },
    mdType() {
      switch (this.mdTypeValue) {
        case "date":
          return Date;
        case "string":
          return String;
        case "number":
          return Number;
      }
    },
    dateFormat() {
      return this.$material.locale.dateFormat || "yyyy-MM-dd";
    },
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
    toString() {
      this.toDate();
      this.dynamicByModel =
        this.dynamicByModel && format(this.dynamicByModel, this.dateFormat);
    },
    toDate() {
      switch (this.type) {
        case "string":
          this.dynamicByModel = parse(
            this.dynamicByModel,
            this.dateFormat,
            new Date()
          );
          break;
      }
    },
    setDone(id, index) {
      this[id] = true;

      this.secondStepError = null;

      if (index) {
        this.active = index;
      }
    },
    setError() {
      this.secondStepError = "This is an error!";
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
        this.registrarEstacion();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
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
    // opcion que seleccion en el select
    getDatosProveedor(val1) {
      let me = this;
      me.loading = true;
      me.idproveedor = val1.id;
      me.demo = 1;
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
    getMarca() {
      let me = this;
      var url = "/marca/selectMarca/?buscar=" + this.idMarca;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMpio = respuesta.marca;
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
    getEstacion() {
      let me = this;
      var url = "/estacion/selectEstacion?buscar=" + this.idTpEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEstacion = respuesta.estacion;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getEtapa() {
      let me = this;

      var url = "/etapa/selectEtapa";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayEtapa = respuesta.etapa;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    getTrenEtapa() {
      let me = this;
      var url = "/trenetapa/selectTrenEtapa/?buscar=" + this.idEtapa;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTrenEtapa = respuesta.trenetapa;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idTpEstacion = data["idtpestacion"]),
        (this.estacion_id = data["id"]);
      this.form.nombre = data["nombre"];
      this.form.descripcion = data["descripcion"];
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },

    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarEstacion(page, buscar, criterio);
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
    listarArticulo(page, buscar, criterio) {
      let me = this;
      var url =
        "/articulo?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayArticulo = respuesta.articulos.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    registrarEstacion() {
      let me = this;

      axios
        .post("/estacion/registrar", {
          idTpEstacion: this.idTpEstacion,
          nombre: this.form.nombre,
          descripcion: this.form.descripcion
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarEstacion(1, "", "nombre");
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
          idTpEstacion: this.idTpEstacion,
          nombre: this.form.nombre,
          descripcion: this.form.descripcion,
          id: this.estacion_id
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarEstacion(1, "", "nombre");
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
    this.getTpEstacion();
    this.getEtapa();
    this.listarEstacion(1, this.buscar, this.criterio);
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
