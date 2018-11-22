<template>
  <div id="app">

    <transition name="fade" mode="out-in" appear>
      <router-view></router-view>
    </transition>

    <loading :is-loading="isLoading"></loading>

  </div>
</template>

<script>
import Loading from './partials/Loading'

export default {

  name: 'App',

  data () {
    return {
      isLoading: false
    };
  },

  components: {
    Loading
  },

  mounted() {
    this.$root.$on('show-loading', data => {
        this.isLoading = data
    });
  }
};
</script>

<style>

</style>