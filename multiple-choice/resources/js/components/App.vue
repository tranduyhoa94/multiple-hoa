<template>
     <div id="app">
      <v-app id="inspire">
        <router-view></router-view>
      </v-app>  
    </div>
</template>

<script>
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
  export default {
    data() {
      return {
        height: $(window).height(),
        hidden: 'auto'
      }
    },
    name: 'App',
    components: {
    }
  }
</script>