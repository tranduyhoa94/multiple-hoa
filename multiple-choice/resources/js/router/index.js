import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import User from '../components/users/index.vue'
import Login from '../components/Login.vue'
import Slide from '../components/sile/index.vue'
import UserDash from '../components/users/UserDash.vue'
import Register from '../components/auths/register.vue'
import LoginIndex from '../components/auths/IndexLogin.vue'

Vue.use(Router)

var routers = [];
routers = [
	{
		path:'/login',
		name:'login',
		component:Login,
		children:[
			{
				path:'/login',
				name:'LoginIndex',
				component:LoginIndex
			},
			{
				path:'/register',
				name:'Register',
				component:Register
			}
		]
	},
	{
		path:'/',
		name:'Dashboard',
		component: Dashboard,
		meta: { requiresAuth: true },
		children : [
			{
				path:'/users',
				name:'indexUser',
				component:User
			},
			{
				path:'/slide',
				name:'Slide',
				component:Slide
			},
			{
				path:'/user-dash',
				name:'UserDash',
				component:UserDash
			}

		]
	},
	// {
	// 	path:'/home',
	// 	name:'Home',
	// 	component:Home
	// }
	{
    // not found handler
    	path: '*',
    	redirect: '/login'
  	}

];

var router = new Router({
    // mode: 'history',
    routes: routers,
});

router.beforeEach((to, from, next) => { 
	console.log(to.fullPath)
	// to.matched.some(record => console.log(record.meta.requiresAuth))
	var access_token = localStorage.getItem('access_token')
	console.log(access_token)
	// if (to.path !== '/login' && !access_token) {
	if (to.matched.some(record => record.meta.requiresAuth) && !access_token) {

    	next('/login');
  	}else if(to.path === '/login' && access_token){
  		next('/users');
  	} 
  	else {
    	next();
  	}
});


export default router;