// uso de material vue
<template>
  <main class="main">
    <div>
      <md-tabs md-sync-route>
        <md-tab id="tab-home" md-label="Inicio" to="/components/tabs/home">
          Home Tab
          <div>
            <md-datepicker v-model="selectedDate" md-immediately />
            <md-field>
              <label for="movie">First day of a week</label>
              <md-select v-model="firstDayOfAWeek">
              
              </md-select>
              <span class="md-helper-text">This config is global.</span>
            </md-field>
          </div>
        </md-tab>

        <md-tab id="tab-pages" md-label="Pages" to="/components/tabs/pages">
          Pages tab
          <p>Unde provident nemo reiciendis officia, possimus repellendus. Facere dignissimos dicta quis rem. Aliquam aspernatur dolor atque nisi id deserunt laudantium quam repellat.</p>
        </md-tab>

        <md-tab id="tab-posts" md-label="Posts" to="/components/tabs/posts">
          Posts tab
          <p>Qui, voluptas repellat impedit ducimus earum at ad architecto consectetur perferendis aspernatur iste amet ex tempora animi, illum tenetur quae assumenda iusto.</p>
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

import "vue-material/dist/vue-material.min.css";
import 'vue-material/dist/theme/default.css'



import { MdButton, MdContent, MdTabs, MdDatepicker  } from "vue-material/dist/components";

Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdTabs);

Vue.use(MdDatepicker);

export default {
  data() {
    return {
    selectedDate: null

    };
  },
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
