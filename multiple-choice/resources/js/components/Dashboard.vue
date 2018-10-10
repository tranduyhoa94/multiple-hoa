<template>
	<div v-bind:style="{ height: height + 'px', overflow:hidden }" class="my-app">
       <app-header></app-header>

       <!-- Left side column. contains the sidebar -->
       <app-sidebar></app-sidebar>

       <!-- Content Wrapper. Contains page content -->
       <router-view style="min-height: 873px"></router-view>
       <!-- /.content-wrapper -->

       <!-- <control-sidebar></control-sidebar> -->

  </div>
</template>

<script>
import Sidebar from '../components/partials/Sidebar.vue';
import Header from '../components/partials/Header.vue';
export default {
  name: 'Dashboard',

  data () {
    return {
    	height: $(window).height(),
        hidden: 'auto'
    }
  },
  components: {
      'app-sidebar': Sidebar,
      'app-header': Header
    }
}
</script>

<style lang="css" scoped>
</style>