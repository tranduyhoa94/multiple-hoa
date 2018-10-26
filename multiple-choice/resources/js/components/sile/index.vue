<template>
	<div>
		<v-carousel hide-delimiters>
		    <v-carousel-item
		      v-for="(item,i) in items"
		      :key="i"
		      :src="item.src"
		    ></v-carousel-item>
  		</v-carousel>
      <button type="button" @click="click()">123</button>
      <!-- <loading :is-loading="isLoading"></loading>  -->
	</div>
</template>

<script>
export default {

  name: 'Slide',

  data () {
    return {
    	items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg'
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg'
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg'
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg'
          }
        ],
        // isLoading: true
    }
  },
  created(){
    // this.isLoading = true
    
  },
  components: {
        // Loading
  },
  methods:{
    click() { 
      this.$root.$emit('show', true)
    }
  }
}
</script>

<style lang="css" scoped>
</style>