import axios from 'axios'

export function get(url) {
    // auth.checkLogin()
    return axios({
    	method: 'GET',
    	url: url
    })
}

export function post(url, data) {
    // auth.checkLogin()
    return axios({
    	method: 'POST',
    	url: url,
    	data: data
    })
}

export function put(url, data) {
    // auth.checkLogin()
    return axios({
        method: 'PUT',
        url: url,
        data: data
    })
}

export function del(url) {
    // auth.checkLogin()
    return axios({
        method: 'DELETE',
        url: url
    })
}