<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Categorías
          <button
            type="button"
            @click="abrirModal('categoria','registrar')"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="imagen-input">Imagen</label>
              <div class="col-md-9">
                <input
                  type="file"
                  class="form-control"
                  placeholder="Seleccione una imagen"
                  name="selectedFile"
                  @change="getImage"
                  accept="image/*"
                >
              </div>
            </div>
            <!-- <md-divider/>
    <div class="block">
      <h3>String</h3>
      <md-datepicker v-model="string"/>
      <div class="value">value: {{string}}</div>
    </div>
            <md-divider/>-->
            <!-- <div class="block">
              <h3>Dynamic By Model</h3>

              <md-radio value="string" @change="toString">String</md-radio>

              <md-datepicker v-model="dynamicByModel"/>
              <div class="value">value: {{dynamicByModel}}</div>
            </div> -->
            <md-divider/>

            <!-- <button type="button" class="btn btn-primary" @click="getImagen()">subir</button> -->

            <!-- <div class="block">
      <h3>Dynamic By Model</h3>
      <md-radio :model="type" value="date" @change="toDate">Date</md-radio>
      <md-radio :model="type" value="string" @change="toString">String</md-radio>
      <md-radio :model="type" value="number" @change="toNumber">Number</md-radio>
      <md-datepicker v-model="dynamicByModel"/>
      <div class="value">value: {{dynamicByModel}}</div>
            </div>-->
            <md-divider/>
        
          </div>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->

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
  </main>
</template>
    </div>
    <!--Inicio del modal agregar/actualizar-->

    <!--Fin del modal-->
  </main>
</template>

<script>
import parse from "date-fns/parse";
//  import isValid from 'date-fns/isValid';
import format from "date-fns/format";

import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdTabs,
  MdDatepicker,
  MdDivider,
  MdField,
  MdIcon,
  MdCard,
  MdSnackbar,
  MdDialog,
  MdRadio
} from "vue-material/dist/components";

Vue.use(MdButton);
Vue.use(MdRadio);
Vue.use(MdSnackbar);
Vue.use(MdCard);
Vue.use(MdIcon);
Vue.use(MdContent);
Vue.use(MdDialog);
Vue.use(MdField);
Vue.use(MdTabs);
Vue.use(MdDatepicker);
Vue.use(MdDivider);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  name: "FormValidation",
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
      string: format(now, dateFormat),
      number: Number(now),
      dynamicByModel: now,
      mdTypeValue: "date",
      dynamicByMdType: now,

      userSaved: false,
      sending: false,
      lastUser: null,

      sending: false,
      categoria_id: 0,
      selectedFile: null,
      form: {
        nombre: "",
        descripcion: ""
      },
      arrayCategoria: [],
      modal: 0,
      tituloModal: "",
      rta: null,
      errorCategoria: 0,
      errorMostrarMsjCategoria: [],
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
    // eslint-disable-next-line
    // type() {
    // if (typeof this.dynamicByModel === "string") {
    //     return "string";
    //   } else if (
    //     Number.isInteger(this.dynamicByModel) &&
    //     this.dynamicByModel >= 0
    //   ) {
    //     return "number";
    //   } else if (this.model === null || this.model === undefined) {
    //     return "null";
    //   } else {
    //     throw new Error("Type error");
    //   }
    // },
    dateFormat() {
      return this.$material.locale.dateFormat || "yyyy-MM-dd";
    },
    mdType() {
      switch (this.mdTypeValue) {
        case "string":
          return String;
      }
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
          this.dynamicByModel = null;
          break;

        case "string":
          this.dynamicByModel = parse(
            this.dynamicByModel,
            this.dateFormat,
            new Date()
          );
          break;

        case "number":
          this.dynamicByModel = new Date(this.dynamicByModel);
          break;
      }
    },
    toString() {
      this.toDate();
      this.dynamicByModel =
        this.dynamicByModel && format(this.dynamicByModel, this.dateFormat);
    },
    toNumber() {
      this.toDate();
      this.dynamicByModel = this.dynamicByModel && Number(this.dynamicByModel);
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
        this.registrarCategoria();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
    },
    getImage(event) {
      //Asignamos la imagen a  nuestra data
      // console.log(event)
      this.selectedFile = event.target.files[0];
    },
    onUpload() {
      let me = this;
      // const config= {'Content-Type': 'multipart/form-data'}
      axios
        .post("/demo/registrar", {
          imagen: this.selectedFile
        })
        .then(function(response) {
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarCategoria(page, buscar, criterio) {
      let me = this;
      var url =
        "/categoria?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayCategoria = respuesta.categorias.data;
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
      me.listarCategoria(page, buscar, criterio);
    },
    registrarCategoria() {
      //   if (this.validarCategoria()) {
      //     return;
      //   }

      let me = this;

      axios
        .post("/categoria/registrar", {
          nombre: this.form.nombre,
          descripcion: this.form.descripcion
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarCategoria(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarCategoria() {
      //   if (this.validarCategoria()) {
      //     return;
      //   }

      let me = this;

      axios
        .put("/demo", {
          nombre: this.form.nombre,
          descripcion: this.form.descripcion,
          id: this.categoria_id
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarCategoria(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    desactivarCategoria(id) {
      swal({
        title: "Esta seguro de desactivar esta categoría?",
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

          axios
            .put("/categoria/desactivar", {
              id: id
            })
            .then(function(response) {
              me.listarCategoria(1, "", "nombre");
              swal(
                "Desactivado!",
                "El registro ha sido desactivado con éxito.",
                "success"
              );
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
    activarCategoria(id) {
      swal({
        title: "Esta seguro de activar esta categoría?",
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

          axios
            .put("/categoria/activar", {
              id: id
            })
            .then(function(response) {
              me.listarCategoria(1, "", "nombre");
              swal(
                "Activado!",
                "El registro ha sido activado con éxito.",
                "success"
              );
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
    validarCategoria() {
      this.errorCategoria = 0;
      this.errorMostrarMsjCategoria = [];

      if (!this.nombre)
        this.errorMostrarMsjCategoria.push(
          "El nombre de la categoría no puede estar vacío."
        );

      if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

      return this.errorCategoria;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.clearForm();
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case "categoria": {
          switch (accion) {
            case "registrar": {
              this.modal = 1;
              this.tituloModal = "Registrar Categoría";
              //   this.nombre = "";
              //   this.descripcion = "";
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              //console.log(data);
              this.modal = 1;
              this.tituloModal = "Actualizar categoría";
              this.tipoAccion = 2;
              this.categoria_id = data["id"];
              this.form.nombre = data["nombre"];
              this.form.descripcion = data["descripcion"];
              break;
            }
          }
        }
      }
    }
  },

  mounted() {
    // this.listarCategoria(1, this.buscar, this.criterio);
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
  background: #2196f3;
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
  background: #F5A528;
  border: 2px solid #F5A528;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
  padding: 2px 5px;
  margin-right: 10px;
}
</style>
