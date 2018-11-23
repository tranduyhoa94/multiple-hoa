<template>
<div>
<v-dialog v-model="dialog" max-width="500px" @keydown.esc="close()">
        <v-card>
          <v-card-title>
            <span class="headline">{{ check ? 'Add Dashboard Widget' : 'Copy Widgets'}}</span>
          </v-card-title>
            <v-card-text>
	       <v-form ref="form" @submit.prevent="saveUser" v-show="check">
				    <v-select
				          :items="dash_items"
				          item-text="title"
				          item-value="widget"
				          v-model="item.widget"
				          label="Choose"
                  :rules="[rules.required]"
				    ></v-select>
				    <span>To User</span>
				    <v-select
				          :items="integra_user_items"
				          item-text="full_name"
				          item-value="email"
				          v-model="item.email"
				          label="Choose User"
                  :rules="[rules.required]"
				    ></v-select>
				    <v-flex justify-center>
				    <v-btn color="info" type="submit">Add</v-btn>
				    </v-flex>
				</v-form>
	      <v-form ref="form1" @submit.prevent="copyUser" v-show="!check">
			    From <v-select
			          :items="integra_user_items"
			          item-text="full_name"
			          item-value="email"
			          v-model="item2.from_user"
			          label="Choose User"
                :rules="[rules.required]"
			    ></v-select> To
			    <v-select
			          :items="integra_user_items"
			          item-text="full_name"
			          item-value="email"
			          v-model="item2.to_user"
			          label="Choose User"
                :rules="[rules.required]"
			    ></v-select>
			    <v-btn color="info" type="submit">Copy</v-btn>
			  </v-form>
          </v-card-text>
          <v-card-actions>
              <v-spacer></v-spacer>
          </v-card-actions>

        </v-card>
</v-dialog>
    <v-snackbar v-model="snack" :timeout="4000" :color="snackColor" right top>
      {{ snackText }}
      <v-btn flat @click="snack = false">Close</v-btn>
    </v-snackbar>
  <div><img src = "https://drive.google.com/uc?id=1rmWEq_IwQEEIRjA3HntuJbyIrGlC8_XZ"></div>
</div>
</template>

<script>
import config from '../../config/index.js'
import { get,post } from '../../helpers/index.js'

export default {

  name: 'add',
 
  // props: ['dialog'],
  data () {
    return {
	    	dash_items:[],
		    integra_user_items:[],
		    item:{},
		    item2:{},
		    dialog: false,
		    check: false,
        rules: {
          required: value => !!value || 'Required.',        
        },
        snack: false,
        snackColor: '',
        snackText: ''
    	}
  	},
  	created(){
      this.fetchData()
      console.log(123);
      // console.log(this.check)
    },
    methods: {
      fetchData(){
        // get(config.API_URL+'admin/dash-widget-integer-user')
        // .then(res => {
        //     if(res && res.status) {
        //       this.dash_items = res.data.dash_widget
        //       this.integra_user_items = res.data.integra_user
        //     }
        // })
      },
      saveUser() {
         if (this.$refs.form.validate()) {
             post(config.API_URL+'save/user-dash',this.item)
             .then(res=> {
                if(res.data && res.data.success){
                      this.snack = true
                      this.snackColor = 'success'
                      this.snackText = 'Data success'
                      this.dialog = false
                      this.$root.$emit('reload-table', true)
                }
             }) .catch((err) => {
                  if(err.response.status === 404){
                      this.snack = true
                      this.snackColor = 'error'
                      this.snackText = 'Data error'
                  }
                })
        //emit refress
        }
        
      },
      copyUser(){
          if (this.$refs.form1.validate()) {
              if(this.item2.from_user == this.item2.to_user) {
                  this.snack = true
                  this.snackColor = 'error'
                  this.snackText = 'Please select two different users'
              } 
              else {
                post(config.API_URL+'copy/user-dash',this.item2)
                .then(res => {
                   if(res.data && res.data.success){
                      this.snack = true
                      this.snackColor = 'success'
                      this.snackText = 'Data success'
                      this.dialog = false
                      this.$root.$emit('reload-table', true)
                    }
                }).catch((err) => {
                  if(err.response.status === 404){
                      this.snack = true
                      this.snackColor = 'error'
                      this.snackText = 'Data error'
                  }
                })
              }
        //emit refress
        }
      },
      close(){
        this.dialog = false;
      }
    },
    components: {
    },
    mounted(){
    	this.$root.$on('change-status', res => {
    		this.dialog = res.showDialog
    		this.check = res.status
    	})
    }
}
</script>

<style lang="css" scoped>
</style>