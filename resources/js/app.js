
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import App from './components/App.vue'
import VueRouter from 'vue-router'
import router from './router'
import Notifications from 'vue-notification'
import config from './config/index.js'
// main.js
import '@fortawesome/fontawesome-free/css/all.css' // Ensure you are using css-loader
import Vuetify from 'vuetify'
import VueEvents from 'vue-events'
import Lodash from 'lodash'
import VueDragscroll from 'vue-dragscroll'
Vue.use(VueDragscroll)

Vue.use(Lodash)

Vue.use(VueEvents)

Vue.use(Vuetify, {
 iconfont: 'fa'
})
Vue.use(Notifications)
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var access_token = localStorage.getItem('access_token')

axios.defaults.baseURL = config.BASE_URL;
axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

// var router = new VueRouter({
//   routes: routes,
//   // mode: 'history',
//   scrollBehavior: function (to, from, savedPosition) {
//     return savedPosition || { x: 0, y: 0 }
//   }
// })


const app = new Vue({
    el: '#app',
    template: '<app></app>',
    components: { App },
    router
})
