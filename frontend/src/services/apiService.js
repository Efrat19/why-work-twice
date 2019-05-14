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
  }

  getAuthSuffix() {
    return `?token=${this.store.getters.getToken}`;
  }

  async setAuth(data) {
    await this.store.dispatch('setUser', data.user);
    await this.store.dispatch('setToken', data.token);
    return this.store.dispatch('setIsSigned', true);
  }

  async clearAuth() {
    await this.store.dispatch('setIsSigned', false);
    await this.store.dispatch('setUser', null);
    return this.store.dispatch('setToken', '');
  }

  async api(method, uri, data){
    const url = this.baseUrl + uri + this.getAuthSuffix();
    return this.axios[method](url, data);
  }


}
export default new ApiService();
