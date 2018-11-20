/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import config from './config'
import router from './router'
import participantAuth from './auth/participant-auth'
import App from './components/App.vue'

/**
 * Config global axios defaults
 */
var POTAL_API_URL = config.API_URL;

if (potal_access == 'PARTICIPANT') {
    POTAL_API_URL = config.PARTICIPANT_API_URL;
}

/**
 * axios config
 */
var access_token = localStorage.getItem('access_token')

axios.defaults.baseURL = POTAL_API_URL;
axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

// Add a request interceptor
axios.interceptors.request.use(function(config) {

    if (program && program.id && program.id_client) {
        if (!config.params) {
            config.params = {}
        }

        config.params.clientId = program.id_client
        config.params.programId = program.id
    }

    return config;
}, function(error) {

    return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function(response) {

    if (response && response.data) {
        return response.data
    }

    return response

}, function(err) {

    if (potal_access == 'PARTICIPANT') {
        // expired token error
        if (err && err.response && err.response.status === 401) {

            participantAuth.clearStorage()
            participantAuth.clearCrossStorage()

            router.push({
                path: '/login'
            });

            return;
        }

        // validate error
        if (err && err.response && err.response.status === 422) {
            return Promise.reject(err.response.data);
        }

        // not participant
        if (err && err.response && err.response.status === 412) {
            if(err.response.data){
                var data = err.response.data

                if(data.code == 'not_found_role'){
                    // except page
                    var exceptPaths = ['/terms', '/help'];
                    var currentPath = window.location.pathname;

                    if(exceptPaths.indexOf(currentPath) < 0){
                        router.push({
                            name: 'select-role'
                        });
                    }

                    return Promise.reject(err);
                }

                participantAuth.clearStorage()

                var params = {}

                if(data.msg){
                    params = {
                        code: err.response.status,
                        message: err.response.data.msg
                    }
                }

                router.push({
                    name: 'participant-error',
                    params: params
                });
            }
        }
    }

    return Promise.reject(err);

});

// get access token in cross storage
if (potal_access == 'PARTICIPANT') {
    if(program && program.id_client){
        crossStorageClient.onConnect().then(function(){
            return crossStorageClient.get('access_token_' + program.id_client)
        }).then(function(token){

            if(token){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                localStorage.setItem('access_token', token);
            }

            // if (potal_access == 'PARTICIPANT') {
                participantAuth.getAuthUser()
            // }

        }).catch(function(error){
            console.log(error);

            // if (potal_access == 'PARTICIPANT') {
                participantAuth.getAuthUser()
            // }
        });
    }
}

const app = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: {
        App,
    }
});