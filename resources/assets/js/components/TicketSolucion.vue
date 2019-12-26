<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Atención de Solicitudes

        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="md-layout">
              <div class="md-layout-item">
                <md-field md-clearable>
                  <label>Qué desea Buscar</label>
                  <md-input v-model="buscar" @keypress="listarDatos(page, buscar, criterio)"></md-input>
                </md-field>
              </div>&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <br />
                <md-button
                  class="md-icon-button md-dense md-raised md-primary"
                  @click="listarDatos(page, buscar, criterio)"
                >
                  <md-icon>search</md-icon>
                </md-button>
              </div>
&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <md-datepicker
                  v-model="fecI"
                  value="fecI"
                  @input="toString"
                  md-immediately
                  :md-model-type="String"
                >
                  <label>Fecha de Inicio</label>
                </md-datepicker>
              </div>&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <md-datepicker
                  v-model="fecF"
                  value="fecF"
                  @input="toString"
                  md-immediately
                  :md-model-type="String"
                >
                  <label>Fecha de Final</label>
                </md-datepicker>
              </div>&nbsp;&nbsp;&nbsp;
              <!-- <div class="md-layout-item">                                         -->
              <!-- </div> -->
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>Ticket</th>
                    <th>Prioridad</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Dirección</th>
                    <th>Municipio</th>
                    <th>Telefono</th>
                    <th>Servicio</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(objeto,index) in arrayDatos" :key="`objeto-${index}`">
                    <td v-text="objeto.idticket"></td>
                    <td>
                      <template v-if="objeto.prioridad=='N'">
                        <span class="badge badge-success">Normal</span>
                      </template>
                      <template v-if="objeto.prioridad=='A'">
                        <span class="badge badge-warning">Media</span>
                      </template>
                      <template else v-if="objeto.prioridad=='MA'">
                        <span class="badge badge-danger">Urgente</span>
                      </template>
                    </td>
                    <td v-text="objeto.fecha"></td>
                    <td v-text="objeto.nombreFull"></td>
                    <td v-text="objeto.direccion"></td>
                    <td v-text="objeto.mpio"></td>
                    <td v-text="objeto.telefono"></td>
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.desc"></td>

                    <td>
                      <template v-if="objeto.edo==0">
                        <span class="badge badge-primary">Registrado</span>
                      </template>
                      <template v-if="objeto.edo==1">
                        <span class="badge badge-warning">Asignado</span>
                      </template>
                      <template else v-if="objeto.edo==2">
                        <span class="badge badge-success">En Ejecución</span>
                      </template>
                      <template else v-if="objeto.edo==3">
                        <span class="badge badge-success">Aprobado</span>
                      </template>
                    </td>
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
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('cedula')">
                      <label for="first-cc">Número de identificación o NIU</label>
                      <md-input
                        @keyup.enter="getUsuario(form.cedula)"
                        class="md-body-2"
                        type="text"
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
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label for="first-name">Nombres</label>
                      <md-input
                        class="md-body-2"
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nombres"
                        :disabled="sending"
                      />

                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label for="first-ape">Apellidos</label>
                      <md-input
                        class="md-body-2"
                        name="first-ape"
                        id="first-ape"
                        autocomplete="given-name"
                        v-model="form.apellidos"
                        :disabled="sending"
                      />

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
                  </div>
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
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>E-mail</label>
                      <span class="md-prefix">
                        <i class="material-icons">email</i>
                      </span>
                      <md-input v-model="form.email" md-counter="80"></md-input>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-35">
                    <md-field md-clearable>
                      <label>Tipo de Solicitud</label>
                      <md-select v-model="idCategoria" md-dense @input="getObjeto">
                        <md-option
                          v-for="cat in arrayCategoria"
                          :key="cat.id"
                          :value="cat.id"
                        >{{cat.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  <!-- <span class="md-body">Tipo de Solicitud</span>
                    <multiselect
                      v-model="arrayC"
                      @input="getObjeto"
                      :options="arrayCategoria"
                      placeholder="Seleccione un Tipo de Solicitud"
                      :custom-label="nameWithCat"
                      label="nombre"
                      track-by="nombre"
                    ></multiselect> -->
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item ">
                    <md-field md-clearable>
                      <label>Objeto de la Solicitud</label>
                      <md-select v-model="idObjeto" md-dense @input="setDispoA">
                        <md-option
                          v-for="objeto in arrayObjeto"
                          :key="objeto.id"
                          :value="objeto.id"
                        >{{objeto.nomobj}}</md-option>
                      </md-select>
                    </md-field>
                    <!-- <span class="md-body">Objeto de la Solicitud</span>
                    <multiselect
                      v-model="arrayO"
                      :options="arrayObjeto"
                      placeholder="Seleccione una causal de Solicitud"
                      :custom-label="nameWithLang"
                      label="nomobj"
                      track-by="nomobj"
                    ></multiselect> -->
                  </div>

                </div>
                                            
                  <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Prioridad</label>
                      <md-select v-model="idPrioridad" md-dense>
                        <md-option
                          v-for="objeto in arrayPrioridad"
                          :key="objeto.id"
                          :value="objeto.id"
                        >{{objeto.name}}</md-option>
                      </md-select>
                    </md-field>
                      <!-- <span class="md-caption">Prioridad</span>
                      <multiselect
                        v-model="arrayP"
                        :options="arrayPrioridad"
                        placeholder="Seleccione un Medio"
                        :custom-label="nameWithPri"
                        label="name"
                        track-by="name"
                      ></multiselect> -->
                  </div>
                  </div>

                <div class="md-layout">
                  <md-field>
                    <label>Descripción suministrada por el usuario</label>
                    <md-textarea v-model="observacion"></md-textarea>
                  </md-field>
                </div>
                <div class="md-layout">
<!--          
                  <md-button class="md-fab-bottom-left md-mini" @click="abrirModal5()">
                    <md-icon>group_add</md-icon>
                  </md-button>  -->
                </div>
                <span class="md-caption">Seleccione uno o varios Técnicos</span>
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Técnico Asignado</th>
                        <th>Rol</th>
                        <th>Opciones</th>
                      </tr>
                      <md-button class="md-icon-button md-primary" @click="abrirModal2()">
                        <md-icon>group_add</md-icon>
                      </md-button>
                    </thead>
                    <tbody v-if="arrayTec.length">
                      <tr v-for="(objeto, index)  in arrayTec" :key="`objeto-${index}`">
                        <td v-text="objeto.nombre"></td>
                        <td>
                          <template v-if="objeto.Rol=='1'">
                            <span class="badge badge-primary">Responsable</span>
                          </template>
                          <template v-else>
                            <span class="badge badge-secondary">Auxiliar</span>
                          </template>
                        </td>
                        <td>
                          <md-button
                            class="md-icon-button md-primary"
                            @click="eliminarDetalle(index)"
                            title="Eliminar"
                          >
                            <i class="material-icons Color4">delete</i>
                          </md-button>
                          <template v-if="objeto.Rol==0">
                            <md-button
                              class="md-icon-button md-primary"
                              @click="setTecnico(arrayTec.indexOf(objeto))"
                              title="Ascender a Lider"
                            >
                              <i class="material-icons Color3">arrow_upward</i>
                            </md-button>
                          </template>
                          <template v-else>
                            <md-button
                              class="md-icon-button md-primary"
                              @click="unsetTecnico(arrayTec.indexOf(objeto))"
                              title="Descender a Lider"
                            >
                              <i class="material-icons Color1">arrow_downward</i>
                            </md-button>
                          </template>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">NO hay Técnicos asignados</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <span class="md-caption">Seleccione una o varias Actividades</span>
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
                    <tbody v-if="arrayServ.length">
                      <tr v-for="(objeto, index)  in arrayServ" :key="`objeto-${index}`">
                        <td v-text="objeto.nombre"></td>
                        <td v-text="objeto.desc"></td>
                        <td>
                          <md-button
                            class="md-icon-button md-primary"
                            @click="eliminarDetalle(index)"
                            title="Eliminar"
                          >
                            <i class="material-icons Color4">delete</i>
                          </md-button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">NO hay Actividades asignadas al servicio</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div v-show="mostrarDisp==1">
                  <span class="md-caption">Disponibilidad Adjunta</span>
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>N° Ticket</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Opciones</th>
                      </tr>

                    </thead>
                    <tbody v-if="arraySelectDA.length">
                      <tr v-for="(objeto, index)  in arraySelectDA" :key="`objeto-${index}`">
                        <td v-text="objeto.id"></td>
                        <td v-text="objeto.fecha"></td>
                        <td v-text="objeto.desc"></td>
                        <td>
                          <md-button
                            class="md-icon-button md-primary"
                            @click="eliminarDetalleD(index)"
                            title="Eliminar"
                          >
                            <i class="material-icons Color4">delete</i>
                          </md-button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">NO hay Disponibilidades asignadas</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
                @click="actualizarTicket()"
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
      :class="{'mostrar' : modal5}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal5()" aria-label="Close">
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
                    >{{objeto.nombre}}</option>
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
                  <tr v-for="(objeto, index)  in arrayServicio" :key="`objeto-${index}`">
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
                    @click.prevent="cambiarPaginaTec(pagination.current_page - 1,buscar,criterio)"
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
                    @click.prevent="cambiarPaginaTec(page,buscar,criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPaginaTec(pagination.current_page + 1,buscar,criterio)"
                  >Sig</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal5()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal2}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal2()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
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
                  <tr v-for="(objeto, index)  in arrayPerso" :key="`objeto-${index}`">
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
                    @click.prevent="cambiarPaginaTec(pagination.current_page - 1,buscar,criterio)"
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
                    @click.prevent="cambiarPaginaTec(page,buscar,criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPaginaTec(pagination.current_page + 1,buscar,criterio)"
                  >Sig</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal2()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
    <!-- /.modal-dialog -->

    <!--Fin del modal-->
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{ mostrar: modal3 }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal3()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
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
                    <th>Ticket</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayDispoA.length">
                  <tr v-for="(objeto, index) in arrayDispoA" :key="`objeto-${index}`">
                    <td v-text="objeto.idticket"></td>
                    <td v-text="objeto.fecha"></td>
                    <td v-text="objeto.desc"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarDispoA(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Disponibilidades APROBADAS.</td>
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
                    @click.prevent="cambiarPaginaTec(page, buscar, criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
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
                  >Sig</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal3()">Cerrar</button>
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
import format from "date-fns/format";
import Multiselect from "vue-multiselect";
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
  components: {
    Multiselect
  },
  data() {
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();
    return {
      form: {
        cedula: "",
        nombres: "",
        apellidos: "",
        email: "",
        email2: ""
      },
      demo: false,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idTicketServ: 0,
      ticket_id: 0,
      idCatServ: 0,
      idUsuario: 0,
      idTec: 0,
      idCategoria: 0,
      idObjeto: 0,
      idPrioridad: "N",
      idMedio: "T",
      tpDoc: "CC",
      genero: "",
      telefono: "",
      direccion: "",
      observacion: "",
      mostrarC: 1,
      modal5: 0,
      modal2: 0,
      modal3: 0,
      mostrarDisp: 0,
      idArea: 0,
      fecI: format(now, dateFormat),
      fecF: format(now, dateFormat),
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
      // array select
      arrayO: { id: 0, nombre: "Seleccione" },
      arrayC: { id: 0, nombre: "Seleccione" },
      arrayA: { id: 0, nombre: "Seleccione" },
      arrayM: { id: "T", nombre: "Seleccione" },
      arrayP: { id: "N", nombre: "Seleccione" },
      arrayL: { id: 0 ,nombre: "Seleccione", nomCargo: "" },
      arrayLider: [],
      arrayArea: [],
      arrayDatos: [],
      arrayDispoA: [],
      arraySelectDA: [],
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
      cedula: {
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
    getValidationClass(fieldName) {
      const field = this.$v.form[fieldName];
      if (field) {
        return {
          "md-invalid": field.$invalid && field.$dirty
        };
      }
    },
    nameWithLang({ nomobj }) {
      return `${nomobj}`;
    },
    nameWithCat({ nombre }) {
      return `${nombre}`;
    },
    nameWithMedio({ name }) {
      return `${name}`;
    },
    nameWithPri({ name }) {
      return `${name}`;
    },
    nameWithL ({ nombreFull, nomCargo }) {
      return `${nombreFull} — [${nomCargo}]`
    },
    validarDatos() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
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
    abrirModal3() {
      // this.idRefE=data["idref"];
      this.modal3 = 1;
      this.tituloModal = "Seleccione una de las Disponibilidades Aprobadas";
      this.getDispoA(1, this.buscar, this.criterio);
    },
    cerrarModal3() {
      this.modal3 = 0;
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
    eliminarDetalleD(index) {
      let me = this;
      me.arraySelectDA.splice(index, 1);
    },
    setDispoA() {
      if (this.idObjeto == 9) {
        this.mostrarDisp = 1;
        this.abrirModal3();
      }
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
    getDetTec() {
      let me = this;

      var url = "/tecserv/detTecnicos?buscar=" + this.ticket_id;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTec = respuesta.detTec;    
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
    getDispoA(page, buscar, criterio) {
      let me = this;
      var url =
        "/ticketserv/getDispoA?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDispoA = respuesta.ticket.data;
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
            me.idUsuario = me.arrayPerso[0]["id"];
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
    agregarDispoA(data = []) {
      let me = this;
      if (me.encuentra3(data["idticket"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Disponibilidad seleccionada ya se encuentra agregado!"
        });
      } else {
        me.arraySelectDA.push({
          id: data["idticket"],
          fecha: data["fecha"],
          desc: data["desc"]
        });
      }
    },
    encuentra3(id) {
      var sw = 0;
      for (var i = 0; i < this.arraySelectDA.length; i++) {
        if (this.arraySelectDA[i].id == id) {
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
        me.arrayServ.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"]
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
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idUsuario = data["id"]), (this.ticket_id = data["idticket"]);
       this.form.cedula = data["id"];
       this.idCategoria = data["idCat"];
       this.getObjeto();
       this.getDetTec();
      this.idObjeto = data["idObjpqrs"];
      this.form.nombres = data["nombres"];
      this.form.apellidos = data["apellidos"];
      this.direccion = data["direccion"];
      this.telefono = data["telefono"];
      this.form.email = data["email"];
      this.observacion = data["desc"];
      this.idMedio = data["medio"];
      this.idPrioridad = data["prioridad"];
    },

    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      // this.arrayO=[];  
      // this.arrayL= [];
      // this.arrayM.id="T";  
      // this.arrayM.name="Telefónico";  
      // this.arrayP.id="N";  
      // this.arrayP.name="Normal";  
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarDatos(page, buscar, criterio) {
      let me = this;
      var url =
        "/ticketserv?page=" +
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
          id_servpqrs: this.idUsuario,
          solucion: this.arrayO.id,
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
    actualizarTicket() {
      let me = this;

      axios
        .put("/ticketserv/actualizar", {
          idTicketServ: this.idTicketServ,
          id_usuario: this.idUsuario,
          id_objpqrs: this.idObjeto,                  
          prioridad: this.idPrioridad,
          estado:1,
          desc: this.observacion.toUpperCase(),
          id: this.ticket_id,
           data: this.arrayTec,
          data2: this.arrayServ
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
          this.ticket_id = data["id"];
          axios
            .post("/estacion/eliminar", {
              id: this.ticket_id
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
    this.getArea();
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
  color: rgb(12, 170, 91);
}
.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
.md-dialog {
  max-width: 768px;
}
</style>
