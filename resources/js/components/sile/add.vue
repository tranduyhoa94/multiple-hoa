<template>

</template>

<script>
export default {

  name: 'add',

  data () {
    return {
    	name:''
    }
  },
  created(){
  	console.log(this.name)
  },
  mounted() {
  	this.$root.$on('test', entry => {
          this.name = entry
     });
  }
}
</script>

<style lang="css" scoped>
</style>