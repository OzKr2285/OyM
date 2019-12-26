<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión de Estaciones
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
                      <md-button class="md-icon-button " @click="mostrarActualizar(estacion)" title="Actualizar">                         
                        <i class="material-icons Color3">edit</i>
                      </md-button>
                      <md-button class="md-icon-button md-primary " @click="eliminarEstacion(estacion)" title="Eliminar">
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
          <div>
            <md-steppers :md-active-step.sync="active" md-linear>
              <md-step
                id="first"
                md-label="Información General"
                md-description="Optional"
                :md-done.sync="first"
              >
                <div class="md-layout">
                  <!-- <div class="md-layout-item" v-show="mostrarC==1">
                    <md-autocomplete md-dense v-model="idDpto"  :md-options="arrayDpto.map(x=>({
                      'id':x.id,
                      'nombre':x.nombre,
                      'toLowerCase':()=>x.nombre.toLowerCase(),
                      'toString':()=>x.nombre
                    }))" @md-changed="getDpto()" @md-opened="getDpto()">
                        <label>Departamento</label>
                    <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.nombre }}</template>
                  </md-autocomplete>
                  </div> -->
                    <div class="md-layout-item">
                    <md-field  >
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
                  <!-- <div class="md-layout-item" v-show="mostrarC==1">
                    <md-autocomplete md-dense v-model="idMp" :md-options="arrayMpio.map(x=>({
                      'id':x.id,
                      'nombre':x.nombre,
                      'toLowerCase':()=>x.nombre.toLowerCase(),
                      'toString':()=>x.nombre
                    }))" @md-changed="getMpio" @md-opened="getMpio">
                        <label>Municipio</label>
                    <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.nombre }}</template>
                  </md-autocomplete>
                  </div> -->
                    <div class="md-layout-item" >
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
                      <md-select v-model="idEstacion" md-dense  @input="getNomEstacion">
                        <md-option
                          v-for="(estacion,index) in arrayEstacion"
                          :key="`estacion-${index}`"
                          :value="estacion.id"                        
                        >{{estacion.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout-item">
                  
                </div>

                <md-button class="md-raised md-primary" @click="setDone('first', 'second')">Continue</md-button>
              </md-step>

              <md-step
                id="second"
                md-label="Asignar Etapas"
                :md-error="secondStepError"
                :md-done.sync="second"                
              >
                <template v-if="bDetEtapa" >             
                  <div class="col-md-12">
                          <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                      <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
                    </tr>
                    <div class="form-group">
                      <button @click="abrirModal" class="btn btn-dark form-control btnagregar">
                        <i class="icon-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody v-if="arrayEtapas.length">
                        <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                        <tr v-for="(detalle, index) in arrayEtapas" :key="`detalle-${index}`">
                          <td v-text="detalle.nombre"></td>
                          <td v-text="detalle.desc"></td>          
                    <td>
                      <md-button class="md-icon-button " @click="eliminarDetalle(index)" title="Eliminar Etapa">                         
                        <i class="material-icons Color4">delete_sweep</i>
                      </md-button>                                                
                      </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="5">NO hay Etapas relacionadas.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="md-layout"></div>

                  <md-button
                    class="md-raised md-primary"
                    @click="setDone2('second', 'third')"
                  >Continue</md-button>
                  <!-- <md-button class="md-raised md-primary" @click="setError()">Set error!</md-button> -->
                </template>

              </md-step>

              <md-step id="third" md-label="Asignar Equipos por Etapa" :md-done.sync="third">
                <template v-if="bDetEtapa">

                <div class="md-layout">
                  <div class="table-responsive col-md-12">
                   <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                    <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
                   </tr>
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody v-if="arrayEtapas.length">
                 
                        <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                        <tr v-for="(detalle, index) in arrayEtapas" :key="`detalle-${index}`">
                          <td v-text="detalle.nombre"></td>
                          <td v-text="detalle.desc"></td>

                          <td>
                            <md-button class="md-icon-button " @click="regEquiposPpal(detalle)" title="Equipos Etapa Principal">                         
                              <i class="material-icons Color1">settings_input_component</i>
                            </md-button>
                            <md-button class="md-icon-button md-primary " @click="regEquiposByPass(detalle)" title="Equipos By Pass">
                              <i class="material-icons Color3">group_work</i>
                            </md-button>                            
                            <md-button class="md-icon-button md-primary " @click="verEquipos(detalle)" title="Ver Equipos">
                              <i class="material-icons Color2">visibility</i>
                            </md-button>                            
                            <!-- <button
                              @click="regEquiposPpal(detalle)"
                              type="button"
                              class="btn btn-dark btn-sm"
                              data-tooltip
                              title="Equipos Etapa Principal"
                            >
                              <i class="icon-check"></i>
                            </button>
                            <button
                              @click="regEquiposByPass(detalle)"
                              type="button"
                              class="btn btn-warning btn-sm"
                              data-tooltip
                              title="Equipos By Pass"
                            >
                              <i class="icon-settings"></i>
                            </button>
                            <button
                              @click="verEquipos(detalle)"
                              type="button"
                              class="btn btn-info btn-sm"
                              data-tooltip
                              title="Ver Equipos"
                            >
                              <i class="icon-eye"></i>
                            </button> -->
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="5">NO hay Etapas relacionadas.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
  
</template>

        <template v-if="bEtapa">
          <!-- Template equipos etapa principal -->
 
          <div class="table-responsive col-md-12">
            <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
              <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
            </tr>
          <h6> {{"Registro Equipos "+this.textoEtapa +"  ( Principal)"}}
        
          <button type="button" @click="abrirModal2()" class="btn btn-dark btn-sm">
            <i class="icon-plus"></i>&nbsp;&nbsp;Agregar
          </button>
          </h6>                  
          <br>

            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>TAG</th>
                  <th>Serial</th>
                  <th>Modelo</th>
                  <th>Nombre</th>                  
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody v-if="arrayTrenPpal.length">
                <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                <tr v-for="(detalle, index) in arrayTrenPpal" :key="`detalle-${index}`">
                  <td v-text="detalle.tag"></td>
                  <td v-text="detalle.serial"></td>
                  <td v-text="detalle.modelo"></td>
                  <td v-text="detalle.nomequipo"></td>                  

                  <td>
                    <md-button class="md-icon-button " @click="eliminarDetalle2(index)" title="Eliminar Equipo">                         
                      <i class="material-icons Color4">delete_forever</i>
                    </md-button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="5">NO hay Equipos relacionados a la etapa seleccionada.</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- <md-button class="md-raised md-primary" @click="setError()">Atras</md-button> -->
          <!-- </div> -->
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="submit" class="md-dense md-raised" @click="ocultarDetalle()">Cerrar</md-button>
              <md-button type="submit" class="md-dense md-raised"  @click="atras()">Atras</md-button>
            </md-card-actions>
            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="registrarEquiposEs()"
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
        </template>
          <template v-else-if="bEtapa==0">
          <!-- Template equipos By Pass -->

          <div class="table-responsive col-md-12">
            <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
              <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
            </tr>
          <h6> {{"Registro Equipos "+this.textoEtapa +"  ( By Pass )"}}
        
          <button type="button" @click="abrirModal2()" class="btn btn-dark btn-sm">
            <i class="icon-plus"></i>&nbsp;&nbsp;Agregar
          </button>
          </h6>
          <br>
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>TAG</th>
                  <th>Serial</th>
                  <th>Modelo</th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody v-if="arrayTrenByPass.length">
                <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                <tr v-for="(detalle, index) in arrayTrenByPass" :key="`detalle-${index}`">
                  <td v-text="detalle.tag"></td>
                  <td v-text="detalle.serial"></td>
                  <td v-text="detalle.modelo"></td>
                  <td v-text="detalle.nomequipo"></td>

                  <td>
                    <md-button class="md-icon-button " @click="eliminarDetalle3(index)" title="Eliminar Equipo">                         
                      <i class="material-icons Color4">delete_forever</i>
                    </md-button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="5">NO hay Equipos relacionados a la etapa seleccionada.</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- </div> -->
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="submit" class="md-dense md-raised" @click="ocultarDetalle()">Cerrar</md-button>
              <md-button type="submit" class="md-dense md-raised"  @click="atras()">Atras</md-button>
            </md-card-actions>
            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="registrarEquiposEs()"
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
                  </template>
              <template v-if="bVerE">
            <!-- Ver equipos etapa principal y Bypass -->

            <div class="table-responsive col-md-12">
              <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
              </tr>
              <h6> {{"Equipos "+this.textoEtapa +"  ( Principal)"}}
              
              </h6>                  
              <br>
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>TAG</th>
                    <th>Serial</th>
                    <th>Modelo</th>
                    <th>Nombre</th>                  
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayTrenPpal.length">
                  <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                  <tr v-for="(detalle, index) in arrayTrenPpal" :key="`detalle-${index}`">
                    <td v-text="detalle.tag"></td>
                    <td v-text="detalle.serial"></td>
                    <td v-text="detalle.modelo"></td>
                    <td v-text="detalle.nombre"></td>                  

                    <td>
                      <button
                        @click="regEquipos(detalle)"
                        type="button"
                        class="btn btn-danger btn-sm"
                        data-tooltip
                        title="Eliminar Etapa"
                      >
                        <i class="icon-close"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Equipos relacionados a la etapa seleccionada.</td>
                  </tr>
                </tbody>
              </table>
                </div>
            <div class="table-responsive col-md-12">
              <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
              </tr>
              <h6> {{"Equipos "+this.textoEtapa +"  ( ByPass)"}}
              
              </h6>                  
              <br>
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>TAG</th>
                    <th>Serial</th>
                    <th>Modelo</th>
                    <th>Nombre</th>                  
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayTrenByPass.length">
                  <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                  <tr v-for="(detalle, index) in arrayTrenByPass" :key="`detalle-${index}`">
                    <td v-text="detalle.tag"></td>
                    <td v-text="detalle.serial"></td>
                    <td v-text="detalle.modelo"></td>
                    <td v-text="detalle.nombre"></td>                  

                    <td>
                      <button
                        @click="regEquipos(detalle)"
                        type="button"
                        class="btn btn-danger btn-sm"
                        data-tooltip
                        title="Eliminar Etapa"
                      >
                        <i class="icon-close"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Equipos relacionados a la etapa seleccionada.</td>
                  </tr>
                </tbody>
              </table>
                </div>
              <div class="modal-footer">
                <md-card-actions>                  
                  <md-button type="submit" class="md-dense md-raised"  @click="atras()">Atras</md-button>
                </md-card-actions>
            </div>
            </template>
            
                <!-- <md-button class="md-raised md-primary" @click="setDone('third')">Done</md-button> -->

         
              <!-- <div class="modal-footer">
                <md-card-actions>
                  <md-button type="submit" class="md-dense md-raised" @click="ocultarDetalle()">Cerrar</md-button>
                  <md-button type="submit" class="md-dense md-raised"  @click="atras()">Atras</md-button>
                </md-card-actions>
                <md-card-actions>
                  <md-button
                    type="submit"
                    v-if="tipoAccion==1"
                    class="md-dense md-raised md-primary"
                    :disabled="sending"
                    @click="registrarEquiposEs()"
                  >Guardar</md-button>
                    
                  <md-button
                    type="submit"
                    v-if="tipoAccion==2"
                    class="md-dense md-raised md-primary"
                    :disabled="sending"
                    @click="actualizarEstacion()"
                  >Actualizar</md-button>
                </md-card-actions>
            </div> -->
              </md-step>
            </md-steppers>
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
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Serial">Serial</option>
                    <option value="nombre">Nombre</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarEtapa(1,buscar,criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarEtapa(1,buscar,criterio)"
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
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(etapa, index)  in arrayEtapa" :key="`etapa-${index}`">
                    <td>
                      <button
                        type="button"
                        @click="agregarDetalleModal(etapa)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="etapa.nombre"></td>
                    <td v-text="etapa.desc"></td>
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page - 1,buscar,criterio)"
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
                      @click.prevent="cambiarPaginaE(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page + 1,buscar,criterio)"
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
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal-dialog -->

    <!-- segunda ventana modal equipos etapas -->
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
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Serial">Serial</option>
                    <option value="Modelo">Modelo</option>
                    <option value="Nombre">Nombre</option>
                    <option value="Descripción">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarExEtapa(1, buscar, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarExEtapa(1, buscar, criterio)"
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
                    <th>TAG</th>
                    <th>Serial</th>
                    <th>Modelo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(etapa, index)  in arrayEquipo" :key="`etapa-${index}`">
                    <td>
                      <button
                        type="button"
                        @click="agregarDetalleModal2(etapa)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="etapa.tag"></td>
                    <td v-text="etapa.serial"></td>
                    <td v-text="etapa.modelo"></td>
                    <td v-text="etapa.nomequipo"></td>
                    <td v-text="etapa.desc"></td>
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page - 1,buscar,criterio)"
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
                      @click.prevent="cambiarPaginaE(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal2()">Cerrar</button>
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

Vue.use(MdSteppers);

import { required, minLength } from "vuelidate/lib/validators";
import { MdAutocomplete } from 'vue-material/dist/components';

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
      idDpto: "",
      idMp: "",
      idEtapa: 0,
      idTrenEtapa: 0,
      idproveedor: 0,
      idMarca: 0,
      tpTren:0,
      numFact: "",
      nomEquipo: "",
      serial: "",
      modelo: "",
      fecCompra: "",
      fecGarantia: "",
      fecInstala: "",
      siExiste:null,
      mostrarC: 1,


      arrayTrenPpal: [],
      arrayTrenEquipos: [],
      arrayTrenByPass: [],
      arrayEquipoEtapa: [],
      arrayEstacion: [],
      arrayNomEstacion: [],
      arrayTpEstacion: [],
      arrayDpto: [],
      arrayMpio: [],
      arrayEtapa: [],
      arrayEquipo: [],
      arrayEtapas: [],
      arrayTrenEtapa: [],
     
      arrayMarca: [],
      modal: 0,
      modal2: 0,
      bDetEtapa: 1,
      bVerE: 0,
      bSave: 1,
      bEtapa: null,
      textoEtapa: "",
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
      criterio: "nomref",
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
       if(this.siExiste){
        swal({
        type: "error",
        title: "Error...",
        text: "La estacion  ya se encuentra agregada!"
        });        
      }else{
        this[id] = true;
        this.secondStepError = null;  
        if (index) {        
          this.active = index;
        }
      }
      
    },
    setDone2(id, index) {
      this[id] = true;
      
      if (!this.arrayEtapas.length){
           this.secondStepError = "Seleccione una Etapa";
      }
      else{
      this.secondStepError = null;

      if (index) {
            this.bDetEtapa=1;
        this.active = index;
      }
      }
    },
    setError() {
      this.secondStepError = "This is an error!";
    },
    abrirModal() {
      this.modal = 1;
      this.tituloModal = "Seleccione una o varias Etapas";
    },
    abrirModal2() {
      this.modal2 = 1;
      this.listarExEtapa(1, "", "");
      this.tituloModal = "Seleccione uno o varios Equipos";
    },
    regEquiposPpal(data = []) {
      this.textoEtapa = data["nombre"];
      this.idEtapa =data["id"];
      this.tpTren =0;
      this.bEtapa = 1;
      this.bDetEtapa = 0;
      this.getExEtapa();
    },
    regEquiposByPass(data = []) {
      this.textoEtapa = data["nombre"];
      this.idEtapa =data["id"];
      this.tpTren =1;
      this.bEtapa = 0;
      this.bDetEtapa = 0;
      this.getExEtapa1();
    },
    verEquipos(data = []) {
      this.bVerE=1;
      this.textoEtapa = data["nombre"];
      this.idEtapa =data["id"];
      this.bEtapa = null;
      this.bDetEtapa = null;
      this.getExEtapa(); 
      this.getExEtapa1();
    },
    atras() {
      // this.arrayTrenPpal=[];
      // this.arrayTrenByPass=[];
      this.bEtapa = null;
      this.bVerE = null;
      this.bDetEtapa = 1;
    },
    cerrarModal() {
      this.modal = 0;
      this.demo = 0;
      this.tituloModal = "";
    },

    cerrarModal2() {
      this.modal2 = 0;
      this.tituloModal = "";
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayEtapas.length; i++) {
        if (this.arrayEtapas[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
  
    getCont() {
    let me = this;

    var url = "/conte/?buscar="+this.idEstacion;
    axios
      .get(url)
      .then(function(response) {
        //console.log(response);
        var respuesta = response.data;
        me.siExiste = respuesta.etapa;
      })
      .catch(function(error) {
        console.log(error);
      });
    },
    agregarDetalleModal(data = []) {
      let me = this;

      if (me.encuentra(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Etapa seleccionada ya se encuentra agregada!"
        });
      } else {
        me.arrayEtapas.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"]
        });
        // me.arrayDetEquipoAct.push({
        //   id: data["id"],
        //   nombre: data["nombre"],
        //   desc: data["desc"],
        //   modelo: data["modelo"],
        //   serial: data["serial"],
        //   rg_temp: data["reg_temp"],
        //   rg_presion: data["reg_presion"],
        //   rg_flujo: data["rg_flujo"]
        // });
      }
    },
    encuentra2(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayTrenPpal.length; i++) {
        if (this.arrayTrenPpal[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra3(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayTrenByPass.length; i++) {
        if (this.arrayTrenByPass[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarDetalleModal2(data = []) {
      let me = this;

        if(this.tpTren==0){
          if (me.encuentra2(data["id"])) {
            swal({
              type: "error",
              title: "Error...",
              text: "El equipo seleccionado ya se encuentra agregada!"
            });
          } else{
          me.arrayTrenPpal.push({
          id: data["id"],
          tag: data["tag"],
          serial: data["serial"],
          modelo: data["modelo"],
          nomequipo: data["nomequipo"],
          desc: data["desc"],
          tp_tren: 0
            });
          me.arrayTrenEquipos.push({
          id: data["id"],
          id_etapa: this.idEtapa,
          tp_tren: 0
        });
        }}
        else {
            if (me.encuentra3(data["id"])) {
            swal({
              type: "error",
              title: "Error...",
              text: "El equipo seleccionado ya se encuentra agregada!"
            });
          } else{
        me.arrayTrenByPass.push({
          id: data["id"],
          tag: data["tag"],
          serial: data["serial"],
          modelo: data["modelo"],
          nomequipo: data["nomequipo"],
          desc: data["desc"],
          tp_tren: 1
        });
        me.arrayTrenEquipos.push({
          id: data["id"],
          id_etapa: this.idEtapa,
          tp_tren: 1
        });
        }
        // me.arrayDetEquipoAct.push({
        //   id: data["id"],
        //   nombre: data["nombre"],
        //   desc: data["desc"],
        //   modelo: data["modelo"],
        //   serial: data["serial"],
        //   rg_temp: data["reg_temp"],
        //   rg_presion: data["reg_presion"],
        //   rg_flujo: data["rg_flujo"]
        // });
          
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
    validarDatos() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.registrarEquiposEs(); 
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
     
      this.form.nombre = null;
      this.form.descripcion = null;
    },

    listarEtapa(page, buscar, criterio) {
      let me = this;
      var url =
        "/etapa?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEtapa = respuesta.etapa.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
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
    listarExEtapa(page, buscar, criterio) {
      let me = this;
      var url =
        "/equipo/exetapa?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
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
    getEtapas() {
      let me = this;
      var url = "/detequipoestacion/etapas/?buscar=" + this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEtapas = respuesta.etapa;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // Traer equipos tren principal
    getExEtapa() {
      let me = this;
      var url = "/detequipoestacion/ppal/?buscar=" + this.idEtapa + '&estacion='+ this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTrenPpal= respuesta.equipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // traer equipos tren Bypass
    getExEtapa1() {
      let me = this;
      var url = "/detequipoestacion/bypass/?buscar=" + this.idEtapa + '&estacion='+ this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTrenByPass= respuesta.equipo;
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
    getNomEstacion() {
      this.getCont();
      let me = this;
      var url = "/estacion/selectNomEstacion?buscar=" + this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayNomEstacion = respuesta.estacion;
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
          me.arrayEtapas = respuesta.etapa;
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
      me.mostrarC = 2;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idTpEstacion = data["idtpes"]),
      this.idDpto = data["idDpto"];

      this.getMpio();
      this.getEstacion();
      this.idMp = data["idmpio"];
      this.idEstacion = data["idEs"];
      this.getEtapas(); 
    },
    mostrarDetalle() {
      this.clearForm();
      this.mostrarC = 1;
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
    cambiarPaginaE(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarEtapa(page, buscar, criterio);
    },
    listarEstacion(page, buscar, criterio) {
      let me = this;
      var url =
        "/detequipoestacion/estacion?page=" +
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
    registrarEquiposEs() {
      let me = this;
      
      // if(this.tpTren==0){
          axios
        .post("/detequipoestacion/registrar", {
          id_estacion: this.idEstacion,
          id_mpio: this.idMp,
          id_etapa: this.idEtapa,
          // tp_tren: this.tpTren,

          data: this.arrayTrenEquipos,

        })
        .then(function(response) {
          // me.ocultarDetalle();
          // me.listarEstacion(1, "", "nombre");
          me.arrayTrenEquipos=[];
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
      // }else{
      //     axios
      //   .post("/detequipoestacion/registrar", {
      //     id_estacion: this.idEstacion,
      //     id_mpio: this.idMp,
      //     id_etapa: this.idEtapa,
      //     tp_tren: this.tpTren,

      //     data: this.arrayTrenByPass,

      //   })
      //   .then(function(response) {
      //     // me.ocultarDetalle();
      //     // me.listarEstacion(1, "", "nombre");
      //     me.mensaje("Guardado", "Guardo ");
      //   })
      //   .catch(function(error) {
      //     console.log(error);
      //   });
      // }
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
    eliminarDetalle(index){
      let me = this;
      me.arrayEtapas.splice(index, 1);
    },
    eliminarDetalle2(index){
      let me = this;
      me.arrayTrenPPal.splice(index, 1);
    },
    eliminarDetalle3(index){
      let me = this;
      me.arrayTrenByPass.splice(index, 1);
    },
    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    this.getDpto();
    this.getTpEstacion();
    // this.getEtapa();
    this.listarEtapa(1, this.buscar, this.criterio);
    this.listarEstacion(1, this.buscar, this.criterio);
    this.listarExEtapa(1, this.buscar, this.criterio);
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

.material-icons.Color1 { color: rgba(252, 183, 34, 0.89); }
.material-icons.Color2 { color: rgba(69, 111, 201, 0.849); }
.material-icons.Color3 { color: rgb(73, 73, 73); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
