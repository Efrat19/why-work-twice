
import Vue from 'vue';
import axios from 'axios';
import store from '../store';

class ApiService {
    constructor(){
        this.axios = axios;
        this.store = store;
        this.baseUrl = 'http://localhost:8000';
    }
    // getCookie(name) {
    //     var value = "; " + document.cookie;
    //     var parts = value.split("; " + name + "=");
    //     if (parts.length === 2) return parts.pop().split(";").shift();
    // }
    addCsrfTo(form) {
        // const data = new FormData();
        // data.append('_token', this.getCookie('XSRF-TOKEN'));
        // Object.keys(form).forEach(key => data.append(key, form[key]));
        // return data;
        return {
            ...form,
            '_token' : Vue.csrfToken,
        };
    }
    setAuthStatus({isSigned, id}){
        // this.store.dispatch('setCsrf', response.data && response.data.csrf);
        this.store.dispatch('setIsSigned', isSigned);
        this.store.dispatch('setUserId', id);
    }
    async getAuthStatus() {
        const response = await axios.get(`${this.baseUrl}/auth-status`);
        axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.csrfToken;
        this.setAuthStatus(response.data);
    }
    async signUp(form) {
        const response = await axios.post(`${this.baseUrl}/register`, this.addCsrfTo(form));
        this.setAuthStatus(response.data);
    }
    async signIn(form) {
        return axios.post(`${this.baseUrl}/login`, {data: this.addCsrfTo(form)});
    }
}
export default new ApiService();