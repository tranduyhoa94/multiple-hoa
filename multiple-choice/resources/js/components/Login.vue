<template>
<div class="form-login-wrapper">
     <main class="login-form">
       <v-container fluid fill-height class="loginOverlay">
          <v-layout flex align-center justify-center>
            <v-flex xs12 sm4 elevation-6>
              <v-toolbar class="pt-5 blue darken-4">
                <v-toolbar-title class="white--text"><h4>Welcome Back</h4></v-toolbar-title>
                </v-toolbar-items>
              </v-toolbar>
              <v-card>
                <v-card-text class="pt-4">
                  <div>
                      <v-form ref="form" @submit.prevent="submit()">
                        <v-text-field
                          v-model="email"
                          prepend-icon="person"
			              :rules="[rules.required, rules.email]"
			              label="E-mail"
                        ></v-text-field>
                        <v-text-field
                          label="Enter your password"
                          v-model="password"
                          :append-icon="e1 ? 'visibility' : 'visibility_off'"
                          :type="e1 ? 'text' : 'password'"
                          @click:append="e1 = !e1"
                          prepend-icon="lock"
                          :rules="[rules.required]"
                        ></v-text-field>
                        <v-layout justify-space-between>
                            <v-btn type="submit">Login</v-btn>
                            <a href="">Forgot Password</a>
                        </v-layout>
                      </v-form>
                  </div>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
       </v-container>
     </main>
</div>
</template>

<script>

export default {

  name: 'Login',

  data () {
    return {
    	email: '',
    	password:'',
    	valid: false,
        e1: false,
       	rules: {
          required: value => !!value || 'Required.',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'Invalid e-mail.'
          }
        }
    }
  },
  methods:{
  	submit(){
  		if (this.$refs.form.validate()) {
  			console.log(this.user)
  		}		
  	}
  }
}
</script>

<style lang="css" scoped>

</style>