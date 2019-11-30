<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Mantenimiento de Estaciones.
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
                    <th>Fecha Realización</th>
                    <th>Fecha Finalización</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayDatos" :key="objeto.id">                                     
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.fec_realiza"></td>
                    <td v-text="objeto.fec_finaliza"></td>
                    <td>       
                      <template v-if="objeto.tp_mto==1">
                        <span class="badge badge-secondary">Preventivo</span>
                      </template>
                      <template v-else>
                        <span class="badge badge-danger">Correctivo</span>
                      </template>
                    </td>
                    <td>
                      <template v-if="objeto.estado==0">
                        <span class="badge badge-primary">Programado</span>
                      </template>
                      <template v-if="objeto.estado==1">
                        <span class="badge badge-warning">En Ejecución</span>
                      </template>
                      <template v-if="objeto.estado==2">
                        <span class="badge badge-success">Finalizado</span>
                      </template>
                      <template else v-if="objeto.estado==3">
                        <span class="badge badge-dark">Reprogramado</span>
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
                        @click="eliminarActE(objeto)"
                        title="Eliminar"
                      >
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
                    <md-datepicker
                      v-model="fecR"
                      value="fecR"
                      @input="toString"
                      md-immediately
                      :md-model-type="String"
                    >
                      <label>Fecha de Realización</label>
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
                      <label>Fecha de Finalización</label>
                    </md-datepicker>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                 <md-field md-clearable>
                      <label>Tipo Mantenimiento</label>
                      <md-select v-model="tpMto" md-dense>
                        <md-option
                          v-for="tipoM in arrayTpMto"
                          :key="tipoM.id"
                          :value="tipoM.id"
                        >{{tipoM.name}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                 <md-field md-clearable>
                      <label>Frecuencia</label>
                      <md-select v-model="frec" md-dense >
                        <md-option
                          v-for="frec in arrayFrec"
                          :key="frec.id"
                          :value="frec.id"
                        >{{frec.name}}</md-option>
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
                <div class="md-layout"></div>

                <md-button class="md-raised md-primary" @click="setDone('first', 'second')">Continue</md-button>
              </md-step>

              <md-step
                id="second"
                md-label="Seleccionar Etapas"
                :md-error="secondStepError"
                :md-done.sync="second"                
              >
                <template v-if="bDetEtapa" >             
                  <div class="col-md-12">
                          <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                      <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
                    </tr>

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
                            <md-button class="md-icon-button md-primary " @click="eliminarDetalle(index)" title="Eliminar">
                              <i class="material-icons Color4">delete</i>
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

              <md-step id="third" md-label="Mantenimiento Equipos" :md-done.sync="third">
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
          <h6> {{"Registro Equipos "+this.textoEtapa +"  (Principal)"}}
        
          <!-- <button type="button" @click="abrirModal2()" class="btn btn-dark btn-sm">
            <i class="icon-plus"></i>&nbsp;&nbsp;Agregar
          </button> -->
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
                    <!-- <button
                      @click="agregarDetalleMto(detalle)"
                      type="button"
                      class="btn btn-success btn-sm"
                      data-tooltip
                      title="Seleccionar Equipo"
                    >
                      <i class="icon-check"></i>
                    </button> -->
                     <template v-if="detalle.edo_mto">
                        <button type="button" class="btn btn-info btn-sm" data-tooltip title="En Mantenimiento" @click="dessetTecnico(articulo.id)">
                          <i class="fa fa-hourglass-start"></i>
                        </button>
                    </template>
                    <template v-else>
                 
                        <button type="button" class="btn btn-success btn-sm" data-tooltip title="Disponible" @click="agregarDetalleMto(detalle)">
                            <i class="icon-check"></i>
                        </button>
                    </template>
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
                      >Guardarr</md-button>
                      
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
                    <template v-if="detalle.edo_mto">
                      <button type="button" class="btn btn-info btn-sm" data-tooltip title="En Mantenimiento" @click="dessetTecnico(articulo.id)">
                        <i class="fa fa-hourglass-start"></i>
                      </button>
                    </template>
                    <template v-else>                 
                      <button type="button" class="btn btn-success btn-sm" data-tooltip title="Disponible" @click="agregarDetalleMto(detalle)">
                        <i class="icon-check"></i>
                      </button>
                    </template>
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
                      >Guardarr</md-button>
                      
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
            <!-- Ver equipos en Mto etapa principal y Bypass -->

            <div class="table-responsive col-md-12">
              <tr v-for="(etapa, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                <h5><td  v-text="'Estación - '+ etapa.nombre"></td></h5>
              </tr>
              <h6> {{"Mantenimiento de Equipos "}}
              
              </h6>                  
              <br>
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Etapa</th>
                    <th>TAG</th>
                    <th>Serial</th>
                    <th>Modelo</th>
                    <th>Nombre</th>                  
                    <th>Tren</th>                  
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayMtoPpal.length">
                  <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                  <tr v-for="(detalle, index) in arrayMtoPpal" :key="`detalle-${index}`">
                    <td v-text="detalle.nomEtapa"></td>
                    <td v-text="detalle.tag"></td>
                    <td v-text="detalle.serial"></td>
                    <td v-text="detalle.modelo"></td>
                    <td v-text="detalle.nombre"></td>                  
                    <td>
                       <template v-if="detalle.tp_tren==0">
                        <span class="badge badge-success">Principal</span>
                      </template>
                      <template v-if="detalle.tp_tren==1">
                        <span class="badge badge-primary">By Pass</span>
                      </template>
                    </td>                  
                    <td>
                    <md-button class="md-icon-button " @click="abrirModal3(detalle)" title="Agregar Actividades">                         
                        <i class="material-icons Color1">playlist_add_check</i>
                    </md-button>
                    <md-button class="md-icon-button md-primary " @click="verAct(detalle)" title="Ver Actividades">
                        <i class="material-icons Color2">visibility</i>
                      </md-button>
                    <md-button class="md-icon-button" @click="abrirModal4(detalle)" title="Agregar Insumos">
                        <i class="material-icons Color1">build</i>
                      </md-button>
                    <md-button class="md-icon-button md-primary" @click="verAct(detalle)" title="Ver Insumos">
                        <i class="material-icons Color3">visibility</i>
                      </md-button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="7">NO hay Equipos relacionados a la etapa seleccionada.</td>
                  </tr>
                </tbody>
              </table>
                </div>
            
                <div class="modal-footer">
                  <md-card-actions>
                    <md-button type="submit" class="md-dense md-raised" @click="ocultarDetalle()">Cerrar</md-button>
                    <md-button type="submit" class="md-dense md-raised"  @click="atras()">Atras</md-button>
                    <md-button class="md-raised md-primary" @click="setDone4('third', 'fourth')">Continue</md-button>
                  </md-card-actions>
              </div>
            </template>
                <!-- <md-button class="md-raised md-primary" @click="setDone('third')">Done</md-button> -->
            
            <template v-if="bVerA">
              <!-- ver las actividades asignadas a cada equipo -->
              <div class="table-responsive col-md-12">
                  <tr v-for="(act, index)  in arrayNomEstacion" :key="`etapa-${index}`">                 
                  <h5><td  v-text="'Actividades - '+ act.nombre"></td></h5></tr>
                    <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Actividad</th>                 
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayMtoAct.length">
                  <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                  <tr v-for="(detalle, index) in arrayMtoAct" :key="`detalle-${index}`">
                    <td v-text="detalle.tag"></td>               

                    <td>
                      <button
                        @click="abrirModal3(detalle)"
                        type="button"
                        class="btn btn-dark btn-sm"
                        data-tooltip
                        title="Agregar Actividades"
                      >
                        <i class="icon-plus"></i>
                      </button>
                      <button
                        @click="abrirModal3(detalle)"
                        type="button"
                        class="btn btn-info btn-sm"
                        data-tooltip
                        title="Ver Actividades"
                      >
                        <i class="fa fa-tasks"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Actividades relacionados a la etapa seleccionada.</td>
                  </tr>
                </tbody>
              </table>

              </div>
                <div class="modal-footer">
                  <md-card-actions>
                    <md-button type="submit" class="md-dense md-raised" @click="ocultarDetalle()">Cerrar</md-button>
                    <md-button type="submit" class="md-dense md-raised"  @click="atrasMnt()">Atras</md-button>
                  </md-card-actions>
                    <!-- <md-card-actions>
                      <md-button
                        type="submit"
                        v-if="tipoAccion==1"
                        class="md-dense md-raised md-primary"
                        :disabled="sending"
                        @click="registrarEquiposEs()"
                      >Guardarr</md-button>
                      
                      <md-button
                        type="submit"
                        v-if="tipoAccion==2"
                        class="md-dense md-raised md-primary"
                        :disabled="sending"
                        @click="actualizarEstacion()"
                      >Actualizar</md-button>
                    </md-card-actions> -->
              </div>
            </template>
        
          </md-step>
          <md-step
            id="fourth"
            md-label="Asignar Técnicos"            
            :md-done.sync="fourt"
          >
          <div class="modal-body">
      <div class="md-layout">
        <!-- <div class="md-layout-item">
          <md-field md-clearable>
            <label>Asignado a:</label>
            <md-select v-model="idTec" md-dense>
              <md-option v-for="(objeto, index)  in arrayPerso" :value="objeto.id"  :key="`objeto-${index}`" @change="agregarTecnico(objeto)"     
              >{{objeto.nombreFull}}</md-option>
            </md-select>
          </md-field>
        </div>&nbsp;&nbsp;&nbsp; -->
           <!-- <div class="md-layout-item">
            <md-field md-clearable>
              <label>Técnico</label>
              <md-select v-model="idTec" md-dense>
                <md-option
                  v-for="perso in arrayPerso"
                  :key="perso.id"
                  :value="perso.id"
                >{{perso.nombre}}</md-option>
              </md-select>
             </md-field>
            </div>&nbsp;&nbsp;&nbsp;  -->
            <!-- <div class="md-layout-item">
            <md-field md-clearable>
                <label>Responsabilidad</label>
                <md-select v-model="idRespo" md-dense >
                  <md-option
                    v-for="frec in arrayRespo"
                    :key="frec.id"
                    :value="arrayRespo.indexOf(frec)"
                  >{{frec}}</md-option>
                </md-select>
              </md-field>
            </div>&nbsp;&nbsp;&nbsp;  -->
   
      
                <!-- <md-button class="md-icon-button md-dense md-raised md-primary" @click="abrirModal5()">
                  <md-icon>supervisor_account</md-icon>
                </md-button> -->
                <md-button class="md-fab-bottom-left md-mini" @click="abrirModal5()">
                 <md-icon>group_add</md-icon>
                </md-button>
            </div>
            
            <div class="table-responsive col-md-12">     
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Técnico Asignado</th>
                    <th>Rol</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayTec.length">
                  <tr v-for="(objeto, index)  in arrayTec" :key="`objeto-${index}`">
                    <td v-text="objeto.nombre"></td>
                    <td>
                      <template v-if="objeto.Rol">
                       <span class="badge badge-primary">Responsable</span>
                      </template>
                      <template v-else>
                        <span class="badge badge-secondary">Auxiliar</span>
                      </template>
                    </td>
                    <td>
                      <md-button class="md-icon-button md-primary " @click="eliminarDetalle(index)" title="Eliminar">
                        <i class="material-icons Color4">delete</i>
                      </md-button>
                      <template v-if="objeto.Rol==0">
                        <md-button class="md-icon-button md-primary " @click="setTecnico(arrayTec.indexOf(objeto))" title="Ascender a Lider">
                        <i class="material-icons Color3">arrow_upward</i>
                      </md-button>
                      </template>
                      <template v-else>
                        <md-button class="md-icon-button md-primary " @click="unsetTecnico(arrayTec.indexOf(objeto))" title="Descender a Lider">
                        <i class="material-icons Color1">arrow_downward</i>
                        </md-button>
                      </template>
                   
                    </td>                         
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Técnicos asignados al mantenimiento</td>
                  </tr>
                </tbody>
              </table>
            <div class="md-layout" md-clearable>
                  <md-field  >
                    <label>Observación del Mantenimiento</label>
                    <md-textarea v-model="descripcion"></md-textarea>
                    <md-icon>description</md-icon>
                  </md-field>
                </div>
            </div>
            </div>
   
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
              >Guardarr</md-button>              
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
                <tbody v-if="arrayAct.length">
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
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Insumos asignados al equipo</td>
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

        <!-- Tercera ventana modal Actividades equipos  -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal3}"
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
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Nombre">Nombre</option>
                    <option value="Descripción">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarActE(1, buscar, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarActE(1, buscar, criterio)"
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
                    <th>Actividad</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayAct.length">
                  <tr v-for="(objeto, index)  in arrayAct" :key="`objeto-${index}`">
                    <td v-text="objeto.desc"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarDetAct(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>                         
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Actividades asignadas al equipo</td>
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
            <button type="button" class="btn btn-secondary" @click="cerrarModal3()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
            <!-- Tercera ventana modal Insumos equipos  -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal4}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal4()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Nombre">Nombre</option>
                    <option value="Descripción">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarInsE(1, this.idRefE, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarInsE(1, this.idRefE, criterio)"
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
                    <th>Actividad</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayIns.length">
                  <tr v-for="(objeto, index)  in arrayIns" :key="`objeto-${index}`">
                    <td v-text="objeto.nombre"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarDetIns(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>                         
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Insumos asignados al equipo</td>
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
            <button type="button" class="btn btn-secondary" @click="cerrarModal4()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
       <!-- Tercera ventana modal Actividades equipos  -->
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
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Nombre">Documento</option>
                    <option value="Descripción">Nombre Técnico</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="getPerso(1, buscar, this.criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
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
                    <td colspan="5">NO hay Actividades asignadas al equipo</td>
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
      <!-- /.modal-dialog -->
    </div>
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
      fourt: false,
      secondStepError: null,
      fourtStepError: null,

      form: {
        descripcion: ""
      },

      tipoAccion: 1,
      fecR: format(now, dateFormat),
      fecF: format(now, dateFormat),
      listado: 1,
      sending: false,
      // variables Mto Estacion

      tpMto: 1,
      frec: 0,
      idRefE:0,
      idTec:0,
      idRespo:0,

      idTpEstacion: 0,
      idEquipo: 0,
      idEstacion: 0,

      idEtapa: 0,
      idMto: 0,
      idTrenEtapa: 0,
      idproveedor: 0,
      idMarca: 0,
      tpTren:0,
      numFact: "",
      nomEquipo: "",
      serial: "",
      modelo: "",

      fecInstala: "",
      descripcion: "",

      // array Mto Estacion
      
      arrayTpMto: [{id: 1, name:"PREVENTIVO"},{id: 2 ,name:"CORRECTIVO"}],      
      arrayFrec: [{id:0 ,name:"INMEDIATO"},{id:1 ,name:"1 MES"},{id:2 ,name:"2 MESES"},{id:3 ,name: "3 MESES"},{id:4 ,name:"4 MESES"},{id:6 ,name:"6 MESES"},{id:9 ,name:"9 MESES"},{id:12 ,name:"12 MESES"},{id:18 ,name:"18 MESES"},{id:24 ,name:"24 MESES"},{id:36 ,name:"36 MESES"}],
      arrayMtoPpal: [],
      arrayMtoByPass: [],
      arrayAct: [],
      arrayIns: [],
      arrayMtoAct: [],
      arrayPerso: [],
      arrayTec: [],
      arrayDatos: [],
      arrayTrenEquipos: [],


      arrayTrenPpal: [],
      arrayTrenByPass: [],
      arrayEquipoEtapa: [],
      arrayEstacion: [],
      arrayNomEstacion: [],
      arrayTpEstacion: [],
      arrayEtapa: [],
      arrayEquipo: [],
      arrayEtapas: [],
      arrayTrenEtapa: [],     
      arrayMarca: [],
      modal: 0,
      modal2: 0,
      modal3: 0,
      modal4: 0,
      modal5: 0,
      bDetEtapa: 1,
      bVerE: 0,
      bVerA: 0,
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
      this[id] = true;
      this.secondStepError = null;
        if (index) {      
          this.active = index;
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
    setDone3(id, index) {
      this[id] = true;
      
      if (!this.arrayMtoPpal.length){
           this.fourtStepError = "Seleccione un Equipo";
      }
      else{
      this.fourtStepError = null;

      if (index) {
            // this.bDetEtapa=1;
        this.active = index;
      }
      }
    },
     setDone4(id, index) {
      this.abrirModal5();
      this[id] = true;
      this.secondStepError = null;
        if (index) {      
          this.active = index;
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
      this.tituloModal = "Seleccione uno o varios Equipos";
    },
    abrirModal3(data = []) {
      this.idRefE=data["idref"];
      this.modal3 = 1;
      this.tituloModal = "Seleccione una o varias Actividades";
      this.listarActE(1, this.buscar, this.criterio);
    },
    abrirModal4(data = []) {
      this.idRefE=data["idRefE"];
      this.modal4 = 1;
      this.tituloModal = "Seleccione una o varios Insumos";
      this.listarInsE(1, this.idRefE, this.criterio);
    },
    abrirModal5() {
      // this.idRefE=data["idref"];
      this.modal5 = 1;
      this.tituloModal = "Seleccione una o varios Técnicos";
      this.getPerso(1,this.buscar, this.criterio);
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
      this.getEqMto();
      // this.getExEtapa();
      // this.getExEtapa1();
    },
    verAct(data = []) {
      this.bVerA=1;
      this.bVerE=null;
      this.textoEtapa = data["nombre"];
      this.idRefE =data["idref"];
      this.bEtapa = null;
      this.bDetEtapa = null;
    },
    atras() {
      this.arrayTrenPpal=[];
      this.arrayTrenByPass=[];
      this.bEtapa = null;
      this.bVerE = null;
      this.bVerA = null;
      this.bDetEtapa = 1;
    },
    // ir a seleccion de mantenimientos
    atrasMnt() {
      // this.arrayTrenPpal=[];
      // this.arrayTrenByPass=[];
      this.bEtapa = null;
      this.bVerE = 1;
      this.bVerA = null;
      this.bDetEtapa = null;
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
    cerrarModal3() {
      this.modal3 = 0;
      this.tituloModal = "";
    },
    cerrarModal4() {
      this.modal4 = 0;
      this.tituloModal = "";
    },
    cerrarModal5() {
      this.modal5 = 0;
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
    encuentra2(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayMtoPpal.length; i++) {
        if (this.arrayMtoPpal[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra3(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayMtoByPass.length; i++) {
        if (this.arrayMtoByPass[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra4(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayMtoAct.length; i++) {
        if (this.arrayMtoAct[i].id == id) {
          sw = true;
        }
      }
      return sw;
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
    setTecnico(id){
      swal({
      title: 'Esta seguro de Asignar al Técnico como Responsable?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false,
      reverseButtons: true
      }).then((result) => {
      if (result.value) {
          let me = this;
          
          me.arrayTec[id].Rol = 1;          
      } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
      ) {
          
      }
      }) 
        },
      unsetTecnico(id){
        swal({
        title: 'Esta seguro de Asignar al Técnico como Auxiliar?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            let me = this;
            
            me.arrayTec[id].Rol = 0;          
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
      }) 
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
      }
    },
    agregarDetAct(data = []) {
      let me = this;

      if (me.encuentra4(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Actividad seleccionada ya se encuentra agregada!"
        });
      } else {
          me.arrayMtoAct.push({
          id: data["id"],
          idRefE: data["idRef"],          
          nombre: data["nombre"],
          desc: data["desc"]
        });
          me.mensaje("Agregar", "Agrego ");
      }
    },
    agregarDetalleMto(data = []) {
      let me = this;
      if(this.tpTren==0){
        if (me.encuentra2(data["idequipo"])) {
            swal({
              type: "error",
              title: "Error...",
              text: "El equipo seleccionado ya se encuentra agregada!"
          });
        } else{
            me.arrayMtoPpal.push({
            id: data["idequipo"], 
            idref:data["idref"],
            tag: data["tag"],
            serial: data["serial"],
            modelo: data["modelo"],
            nomequipo: data["nombre"],
            desc: data["desc"]
          });
          me.arrayTrenEquipos.push({
          id: data["id"],
          id_equipo: data["idequipo"],
          tp_tren: 0
        });
            me.mensaje("Agregar", "Agrego ");
          }
      }
      else {
        if (me.encuentra3(data["idequipo"])) {
          swal({
          type: "error",
          title: "Error...",
          text: "El equipo seleccionado ya se encuentra agregada!"
        });
      } else{
          me.arrayMtoByPass.push({
          id: data["idequipo"],
          tag: data["tag"],
          serial: data["serial"],
          modelo: data["modelo"],
          nomequipo: data["nombre"],
          desc: data["desc"]
    });
           me.arrayTrenEquipos.push({
          id: data["id"],
          id_equipo: data["idequipo"],
          tp_tren: 1
        });
        me.mensaje("Agregar", "Agrego ");
        }        
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
    listarMto(page, buscar, criterio) {
      let me = this;
      var url =
        "/mto?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDatos = respuesta.mto.data;          
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
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
    listarActE(page, buscar, criterio) {
      let me = this;
      var url =
        "/detactequipo/actE?page=" + page + "&buscar=" + this.idRefE + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayAct = respuesta.actividad.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarInsE(page, buscar, criterio) {
      let me = this;
      var url =
        "/detinsumo/insumose?page=" + page + "&buscar=" +  this.idRefE + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayIns = respuesta.insumose.data;
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
    // opcion  seleccion en el select
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
    getEqMto() {
      let me = this;
      var url = "/detmtoes/?buscar=" + this.idMto;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMtoPpal= respuesta.equipo;
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
      this.getEtapas();
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
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idTpEstacion = data["idtpes"]),     

      this.getEstacion();
      this.idEstacion = data["idEs"];
      this.getEtapas(); 
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
    cambiarPaginaE(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarEtapa(page, buscar, criterio);
    },
    cambiarPaginaTec(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.getPerso(page, buscar, criterio);
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

    registrarEquiposEs() {
      let me = this;
        
        if(this.tpTren==0){
            axios
          .post("/mto/registrar", {
            id_estacion: this.idEstacion,
            fec_realiza: this.fecR,
            fec_finaliza: this.fecF,
            tp_mto: this.tpMto,
            frec: this.frec,

            data: this.arrayTrenEquipos,

          })
          .then(function(response) {
            me.arrayTrenEquipos=[];
            // me.ocultarDetalle();
          var respuesta = response.data;
          me.idMto = respuesta.idMto;
            // me.listarMto(1, "", "nombre");
          
            me.mensaje("Guardado", "Guardo ");
          })
          .catch(function(error) {
            console.log(error);
          });
        }else{
            axios
          .post("/mto/registrar", {
            id_estacion: this.idEstacion,
            fec_realiza: this.fecR,
            fec_finaliza: this.fecF,
            tp_mto: this.tpMto,
            frec: this.frec,
            data: this.arrayTrenEquipos,

          })
          .then(function(response) {
            me.arrayTrenEquipos=[];
            // me.ocultarDetalle();
            // me.listarEstacion(1, "", "nombre");
            me.mensaje("Guardado", "Guardo ");
          })
          .catch(function(error) {
            console.log(error);
          });
        }
    
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
    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    this.getPerso(1,this.buscar, this.criterio);
    this.listarMto(1,this.buscar, this.criterio);
    this.getTpEstacion();
    // this.getEtapa();
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
.material-icons.Color1 { color: rgb(31, 33, 34); }
.material-icons.Color2 { color: rgba(52, 139, 64, 0.849); }
.material-icons.Color3 { color: rgb(31, 114, 134); }
.material-icons.Color4 { color: rgb(248, 53, 46); }
</style>
