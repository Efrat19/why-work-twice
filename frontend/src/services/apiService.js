
import Vue from 'vue';
import axios from 'axios';
import store from '../store';

class ApiService {
    constructor(){
        this.axios = axios;
        this.store = store;
        this.baseUrl = 'http://localhost:8000';
    }
    setUser({ user }) {
        this.store.dispatch('setIsSigned', !!user);
        this.store.dispatch('setUser', user);
    }
    async register(form) {
        const response = await axios.post(`${this.baseUrl}/api/register`, form);
        this.setUser(response.data);
    }
    async login(form) {
        const response = await axios.post(`${this.baseUrl}/api/login`, form);
        this.setUser(response.data);
    }
    async logout() {
        const response = await axios.post(`${this.baseUrl}/api/logout`);
        this.setUser(response.data);
    }
}
export default new ApiService();