import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import User from '../components/users/index.vue'
import Login from '../components/Login.vue'


Vue.use(Router)

var routers = [];
routers = [
	{
		path:'/login',
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

];

var router = new Router({
    // mode: 'history',
    routes: routers,
});

router.beforeEach((to, from, next) => { 
	// console.log(to.fullPath)
	var access_token = localStorage.getItem('access_token')
	if (to.path !== '/login' && !access_token) {
    	next('/login');
  	}else if(to.path === '/login' && access_token){
  		next('/');
  	} 
  	else {
    	next();
  	}
});


export default router;