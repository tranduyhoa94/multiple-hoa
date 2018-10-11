import Home from '../components/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import User from '../components/users/index.vue'
import Login from '../components/Login.vue'
let	routes = [
	{
		path:'/',
		name:'login',
		component:Login
	},
	{
		path:'/',
		name:'Dashboard',
		component: Dashboard,
		children : [
			{
				path:'/users',
				name:'indexUser',
				component:User
			}
		]
	},
	{
		path:'/home',
		name:'Home',
		component:Home
	}

]


export default routes