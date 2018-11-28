<template>
	<div>
	    <v-card-actions v-for="(item, index) in items" :key="index">
	    	<v-btn :color="item.color" block large dark class="font-weight-bold custom" @click="login(item.driver)">
	      	<v-icon dark class="mr-3">{{ item.icon }}</v-icon>
    			{{ item.text }}
	    	</v-btn>
	    </v-card-actions>
  </div>
</template>

<script>
import config from '../../config/index.js'
export default {

  name: 'SocialLogin',

  data () {
    return {
	    	items: [
	    		{
		          text: 'Sign In With Facebook',
		          icon: 'fab fa-facebook-f',
		          color: '#29487d',
		          driver: 'facebook'
	        	},
		        {
		          text: 'Sign In With Google',
		          icon: 'fab fa-google-plus',
		          color: '#f34335',
		          driver: 'google'
		        },
    		],
    	}  
  	},
  	computed: {
    	googleAuth: () => window.config.googleAuth,
    	facebookAuth: () => window.config.facebookAuth,
  	},

  	mounted () {
   		 window.addEventListener('message', this.onMessage, false)
	},

	beforeDestroy () {
	    window.removeEventListener('message', this.onMessage)
	},

	methods:{
		login(driver) {
		const newWindow = openWindow('', 'login')

		var url = config.API_URL+'oauth/' + driver
		axios.post(url, {
      		provider: driver
		      })
		      .then(response => {
		        const url = response.data.url
		      	newWindow.location.href = url
		      })
		      .catch(error => {
		   
		      })
		},
		onMessage (e) {
	     	console.log(e)
	      if (e.origin !== window.origin || !e.data.token) {
	        return
	      }
	        localStorage.setItem('access_token', e.data.token)
		      axios.defaults.headers.common['Authorization'] = localStorage.getItem('access_token')
		      this.$router.push('/');
	      // console.log(e.data.token)

	      // this.$store.dispatch('auth/saveToken', {
	      //   token: e.data.token
	      // })

	      // this.$router.push({ name: 'home' })
	    }
	}
}

/**
 * @param  {Object} options
 * @return {Window}
 */
function openWindow (url, title, options = {}) {
  if (typeof url === 'object') {
    options = url
    url = ''
  }
  options = { url, title, width: 500, height: 620, ...options }
  const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left
  const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top
  const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width
  const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height
  options.left = ((width / 2) - (options.width / 2)) + dualScreenLeft
  options.top = ((height / 2) - (options.height / 2)) + dualScreenTop
  const optionsStr = Object.keys(options).reduce((acc, key) => {
    acc.push(`${key}=${options[key]}`)
    return acc
  }, []).join(',')
  const newWindow = window.open(url, title, optionsStr)
  if (window.focus) {
    newWindow.focus()
  }
  return newWindow
}
</script>

<style lang="css" scoped>
.custom{
		letter-spacing: 0.1px;
		font-size: 16px;
	}
</style>