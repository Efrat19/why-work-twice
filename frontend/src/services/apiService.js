
import Vue from 'vue';
import axios from 'axios';
import store from '../store';

class ApiService {
    constructor(){
        this.axios = axios;
        this.store = store;
        this.baseUrl = 'http://localhost:8000';
    }
    // addCsrfTo(form) {
    //     return {
    //         ...form,
    //         '_token' :
    //     };
    // }
    // setCsrf(){
    //
    // }
    setAuthStatus({isSigned, id}){
        this.store.dispatch('setIsSigned', isSigned);
        this.store.dispatch('setUserId', id);
    }
    async getAuthStatus() {
        const response = await axios.get(`${this.baseUrl}/auth-status`);
        this.setAuthStatus(response.data);
    }
    async signUp(form) {
        const response = await axios.post(`${this.baseUrl}/api/register`, form);
        this.setAuthStatus(response.data);
    }
    async signIn(form) {
        return axios.post(`${this.baseUrl}/login`, {data: this.addCsrfTo(form)});
    }
}
export default new ApiService();