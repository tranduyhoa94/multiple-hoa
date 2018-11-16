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
      <div class="col-sm-12">
          <input type="file" ref="file" name="file" class="form-control-file" @change="setFileName()">
      </div>
      <button type="button" @click="test()">12312312312</button>
      <!-- <loading :is-loading="isLoading"></loading>  -->
	</div>
</template>

<script>
import { get,del,post } from '../../helpers/index.js'
import config from '../../config/index.js'
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
        file_name:''
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
    },
     setFileName(){
          this.file_name = this.$refs.file.files[0];
          console.log(this.$refs.file.files[0])
    },
    test(){
        console.log(config.API_URL+'proposals')
        let formData = new FormData();
            formData.append('file_name', this.file_name)
            formData.append('test', 'hoa')

            // let params = {
            //     anc:'123'
            // }
            // console.log(params)
            
        post(config.API_URL+'proposals',formData)
          .then((res) => {
                  // if(res.data && res.data.success){
                  //     // this.loading = false
                  //     this.$notify({
                  //         message: res.data.message,
                  //         title: 'Success',
                  //         type: 'success'
                  //     })
                  //     this.$router.push('/work')
                  // }else{
                  //     this.$notify({
                  //         message: res.data.message,
                  //         title: 'Error',
                  //         type: 'error'
                  //       })
                  //   }
                })
        // console.log(this.formData)
    }
  }
}
</script>

<style lang="css" scoped>
</style>