<template>
<v-flex xs12 sm4 elevation-6>
      <v-toolbar class="pt-5 blue darken-4">
        <v-toolbar-title class="white--text"><h4>Welcome Back</h4></v-toolbar-title>
        </v-toolbar-items>
      </v-toolbar>
      <v-card>
        <v-card-text class="pt-4">
        <social-login></social-login>
          <div>
              <v-form ref="form" @submit.prevent="submit()">
                <v-text-field
                  v-model="user.email"
                  prepend-icon="person"
	              :rules="[rules.required, rules.email]"
	              label="E-mail"
                ></v-text-field>
                <v-text-field
                  label="Enter your password"
                  v-model="user.password"
                  :append-icon="e1 ? 'visibility' : 'visibility_off'"
                  :type="e1 ? 'text' : 'password'"
                  @click:append="e1 = !e1"
                  prepend-icon="lock"
                  :rules="[rules.required]"
                ></v-text-field>
                <v-layout justify-space-between>
                    <v-btn type="submit">Login</v-btn>
                    <a href="#" @click="test()">Forgot Password</a>
                </v-layout>
              </v-form>
              <notifications group="foo" />
          </div>
        </v-card-text>
      </v-card>
</v-flex>
</template>

<script>
import auth from '../../auth/index.js'
import SocialLogin from './SocialLogin'

export default {

  name: 'IndexLogin',

	data () {
	   return {
	   		user:{},
    		valid: false,
        	e1: false,
      		token:'',  
	       	rules: {
	          required: value => !!value || 'Required.',
	          email: value => {
	            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	            return pattern.test(value) || 'Invalid e-mail.'
	          }
	        },
 
	    }
	},
	methods:{
  	submit(){

      // var abc =  auth.test()
      // console.log(abc)
  		if (this.$refs.form.validate()) {
  			var data = auth.login(this.user.email,this.user.password)
          console.log(data)
          data.then(res => {
            
             if(res === 500) {
                this.$notify({
                  group: 'foo',
                  title: 'Important message',
                  text: 'Something error. Please try again!',
                  type : 'error'
                });
                this.status = ''
              } 
          })
     
        // this.token =  localStorage.getItem('access_token')

  		}		
  	},
    	test(){
    		// this.$notify({
      //   group: 'foo',
      //   title: 'Important message',
      //   text: 'Hello user! This is a notification!',
      //   type : 'error'
      // });
  	}
  },
   components:{
    SocialLogin
  },
}
</script>

<style lang="css" scoped>
</style>