// uso de material vue
<template>
  <main class="main">
    <div>
      <md-tabs md-sync-route>
        <md-tab id="tab-home" md-label="Calendario" class="icon-bag" to="/components/tabs/home">
          Calendario
          <div class="col-md-8">
            <div>
              <md-datepicker v-model="selectedDate" md-immediately/>
            </div>
          </div>
        </md-tab>

        <md-tab id="tab-pages" md-label="Mercancia" to="/components/tabs/pages">
          <md-field>
            <label>Nombre del Cliente</label>
            <md-input v-model="type"></md-input>
            <span class="md-helper-text">Nombre</span>
          </md-field>
        </md-tab>

        <md-tab id="tab-posts" md-label="Demo Componentes" to="/components/tabs/posts">
          Posts tab
           <div class="col-md-4">
              <div class="form-group">
                  <label>Serie Comprobante</label>
                  <input type="text" class="form-control" v-model="serie_comprobante" placeholder="000x">
              </div>
                 <div class="form-group">
                  <label>Serie Comprobante</label>
                  <input type="text" class="form-control" v-model="serie_comprobante" placeholder="000x">
              </div>
          </div>
          <div class="form-group row">
            <div >
              <md-field>
                <label>Nombre</label>
                <md-input v-model="withLabel" placeholder="Ingrese el Nombre del Cliente"></md-input>
              </md-field>
            </div>
            <div >
              <md-field>
                <label>Nombre</label>
                <md-input v-model="withLabel" placeholder="Ingrese el Nombre del Cliente"></md-input>
              </md-field>
            </div>
          </div>
        </md-tab>

        <md-tab id="tab-favorites" md-label="Favorites" to="/components/tabs/favorites">
          Favorites tab
          <p>Maiores, dolorum. Beatae, optio tempore fuga odit aperiam velit, consequuntur magni inventore sapiente alias sequi odio qui harum dolorem sunt quasi corporis.</p>
        </md-tab>
      </md-tabs>
    </div>
  </main>
</template>

<script>
// import "vue-material/dist/vue-material.min.css";
// import "vue-material/dist/theme/default.css";

import {
  MdButton,
  MdContent,
  MdTabs,
  MdDatepicker,
  MdField,
  MdIcon,
  MdDialog
} from "vue-material/dist/components";

Vue.use(MdButton);
Vue.use(MdIcon);
Vue.use(MdContent);
Vue.use(MdDialog);
Vue.use(MdField);
Vue.use(MdTabs);
Vue.use(MdDatepicker);

export default {
  name: "BasicDatepicker",
  data: () => ({
    selectedDate: null,
    type: null
  }),
  computed: {
    firstDayOfAWeek: {
      get() {
        return this.$material.locale.firstDayOfAWeek;
      },
      set(val) {
        this.$material.locale.firstDayOfAWeek = val;
      }
    }
  }
};
</script>





