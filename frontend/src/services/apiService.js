import Vue from 'vue';
import axios from 'axios';
import store from '../store';
import router from '../router';

class ApiService {
  constructor() {
    this.axios = axios;
    this.store = store;
    this.router = router;
    this.baseUrl = 'http://localhost:8000/api';
    this.attemptAuthFromLocalStorage();
  }

  async getAuthSuffix() {
    const token = await localStorage.getItem('token');
    return `?token=${token}`;
  }

  async updateStore(data) {
    await this.store.dispatch('setUser', data.user);
    return this.store.dispatch('setIsSigned', true);
  }

  async updateLocalStorage(data) {
    await localStorage.setItem('token', data.token);
    return localStorage.setItem('user', JSON.stringify(data.user));
  }

  async setAuth(data){
    await this.updateLocalStorage(data);
    return this.updateStore(data);
  }

  async clearAuth() {
    await this.store.dispatch('setIsSigned', false);
    await this.store.dispatch('setUser', null);
    await localStorage.removeItem('user');
    return localStorage.removeItem('token');
  }

  async api(method, uri, data) {
    const suffix = await this.getAuthSuffix();
    const url = this.baseUrl + uri + suffix;
    return this.axios[method](url, data);
  }

  async attemptAuthFromLocalStorage(){
    const auth = {
      user: JSON.parse(localStorage.getItem('user')),
      token: localStorage.getItem('token'),
    }
    return auth.user && auth.token && this.updateStore(auth);
  }

}
export default new ApiService();
