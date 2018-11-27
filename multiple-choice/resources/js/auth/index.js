import router from '../router/index.js'
export default {
	user:{
		authenticated: false,
		profile: null,
	},
	login(email,pword){

		return axios.post('api/auth/login',{
			email:email,
			password: pword
		})
		.then(res => {

			if(res.data && res.data.success){
				localStorage.setItem('access_token', res.data.data.user.access_token)
                localStorage.setItem('first_name', res.data.data.user.first_name)
                axios.defaults.headers.common['Authorization'] =  localStorage.getItem('access_token')
                this.authenticated = true

                router.push({
                	name:'Dashboard'
                })

			} else {
				return res.data.status
			}
		})
		.catch((err) =>{
			console.log(err)
		});

	},
	logout(){
		localStorage.removeItem('access_token')
        router.push({
            name: 'LoginIndex'
        })
	},
	test(){
		return 'test'
	}
}