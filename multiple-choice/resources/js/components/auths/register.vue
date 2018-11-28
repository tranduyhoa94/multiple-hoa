<template>
<v-content class="animated">
    <v-container fluid fill-height>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
          <!--  -->
          <v-card class="elevation-12">
         <v-toolbar class="pt-5 blue darken-4">
	        <v-toolbar-title class="white--text"><h4>Register</h4></v-toolbar-title>
	        </v-toolbar-items>
	      </v-toolbar>
            <v-card-text>
              <v-form ref="form">

              	<v-text-field prepend-icon="fas fa-file-signature" :rules="[rules.required,rules.alpha]" name="firstname" label="First name" type="text" color="green darken-2" v-model="user.firstname"></v-text-field>

                <v-text-field prepend-icon="fas fa-file-signature" :rules="[rules.required, rules.alpha]"  name="lastname" label="Last name" type="text" color="green darken-2" v-model="user.lastname"></v-text-field>

                <v-text-field prepend-icon="fas fa-envelope" :rules="[rules.required, rules.email]"  name="email" label="Email" type="text" color="green darken-2" v-model="user.email"></v-text-field>

                <v-text-field prepend-icon="fas fa-user-lock" :rules="[rules.required, rules.password]" name="password" label="Password" id="password" type="password" color="green darken-2" v-model="user.password" :append-icon="showPassword ? 'visibility_off' : 'visibility'" @click:append="showPassword = !showPassword" :type="showPassword ? 'text' : 'password'"></v-text-field>

                <v-text-field prepend-icon="fas fa-user-lock" :rules="[rules.required, rules.password, rules.passwordConfirm]"  name="passwordConfirm" label="Confirm Password" id="passwordConfirm" v-model="user.passwordConfirm" type="password" color="green darken-2" :append-icon="showPasswordCfr ? 'visibility_off' : 'visibility'" @click:append="showPasswordCfr = !showPasswordCfr" :type="showPasswordCfr ? 'text' : 'password'"></v-text-field>

              </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn block dark color="#1ab394" class="font-weight-bold pl-5 pr-5" @click="register">Start my free trial today</v-btn>
            </v-card-actions>
            <v-card-text>
            	<div class="text-center text-muted subheading">
            		Already have a Interage account? <router-link to="/login">Login</router-link>
            	</div>
            </v-card-text>
          </v-card>
          <!--  -->
        </v-flex>
      </v-layout>
    </v-container>
     <v-snackbar v-model="snack" :timeout="4000" :color="snackColor" right top>
      {{ snackText }}
      <v-btn flat @click="snack = false">Close</v-btn>
    </v-snackbar>
  </v-content>
</template>

<script>
import { post } from '../../helpers/index.js'
import config from '../../config/index.js'
export default {

  name: 'Register',

  data () {
    return {
    	snack: false,
        snackColor: '',
        snackText: '',
    	showPassword: false,
      	showPasswordCfr: false,
      	user:{},
      	rules: {
        required: value => !!value || 'This field is required.',
        alpha: value => {
            const pattern = /(^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$)/
            return pattern.test(value) || 'You should use the word for this field.'
        },
        password: value => {
          const pattern = /^(.*(?=.{8,})((?=.*[!@#$%^&*()\-_=+{};:,<.>]){1})(?=.*\d)((?=.*[a-z]){1}).*)$/
          return pattern.test(value) || 'This password must be contain: capital letter, number, special character e.g. 123!@#abc'
        },
        passwordConfirm: value => value == this.user.password || 'Password confirm not same password',
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Please input correct e-mail format.'
        }
      },
    }
  },
  methods:{
  	register(){

  		if (this.$refs.form.validate()) {
		  	let url = config.API_URL+'register'
		  	post(url,this.user)
		  	.then((res)=> {
		  		if(res.data && res.data.success){
		  			this.snack = true
                    this.snackColor = 'success'
                    this.snackText = 'Success Data'
                     setTimeout( () => this.$router.push({ path: '/login'}), 1000);
                    
		  		} else {
		  			this.snack = true
                    this.snackColor = 'error'
                    this.snackText = 'This email is existed in the system.'
		  		}
		  	}).catch((err) => {
				console.log(err)  	  	
		  	})
  		}
  	}
  }
}
</script>

<style lang="css" scoped>
</style>