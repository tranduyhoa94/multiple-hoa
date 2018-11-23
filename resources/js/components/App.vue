<template>
     <div id="app">
      <v-app id="inspire">
        <router-view></router-view>
        <loading :is-loading="isLoading"></loading>  
      </v-app>
      
    </div>
</template>

<script>
import 'vuetify/dist/vuetify.min.css'
import Loading from '../components/partials/Loading.vue'


  export default {
    data() {
      return {
        isLoading: false
      }
    },

    name: 'App',

    components: {
       Loading
    },

    mounted() {
      this.$root.$on('show', data => {
          this.isLoading = data
      })
    }
  }
</script>