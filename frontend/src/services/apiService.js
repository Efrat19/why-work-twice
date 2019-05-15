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
    this.user = null;
    this.isSigned = false;
    this.token = '';
    this.attemptAuthFromLocalStorage();
  }

  async api(method, uri, data) {
    const suffix = await this.getAuthSuffix();
    const url = this.baseUrl + uri + suffix;
    return this.axios[method](url, data);
  }

  getAuthSuffix() {
    return `?token=${this.token}`;
  }

  async setToken(token) {
    this.token = token;
    return localStorage.setItem('token', token);
  }

  async setUser(user) {
    this.user = user;
    this.isSigned = true;
    return localStorage.setItem('user', JSON.stringify(user));
  }

  async setAuth(data) {
    await this.setToken(data.token);
    return this.setUser(data.user);
  }

  async clearAuth() {
    this.isSigned = false;
    this.user = null;
    this.token = '';
    await localStorage.removeItem('user');
    return localStorage.removeItem('token');
  }

  async attemptAuthFromLocalStorage() {
    this.user = await JSON.parse(localStorage.getItem('user'));
    this.isSigned = !!this.user;
    this.token = await localStorage.getItem('token');
  }

}
export default new ApiService();
