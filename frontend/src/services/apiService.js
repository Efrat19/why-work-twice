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

  setAuth(data) {
    this.store.dispatch('setIsSigned', !!data.user);
    this.store.dispatch('setUser', data.user);
    this.store.dispatch('setToken', data.access_token);
  }

  async register(form) {
    const response = await this.axios.post(`${this.baseUrl}/register`, form);
    this.setAuth(response.data);
  }

  async login(form) {
    const response = await this.axios.post(`${this.baseUrl}/login`, form);
    this.setAuth(response.data);
  }

  async logout() {
    const response = await this.axios.get(`${this.baseUrl}/logout${this.getAuthSuffix()}`);
    this.setAuth(response.data);
  }

  async api(method, uri, data, onSuccess, onFailure){
    const url = this.baseUrl + uri + this.getAuthSuffix();
    try {
      const response = this.axios[method](url,data);
      onSuccess && onSuccess(response.data);
    }
    catch (error) {
      onFailure && onFailure(error)
    }
  }

}

export default new ApiService();
