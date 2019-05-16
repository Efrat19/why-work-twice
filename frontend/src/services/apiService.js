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

  async setToken(token,expires) {
    this.token = token;
    await localStorage.setItem('token', token);
    return localStorage.setItem('expires', expires);
  }

  async setUser(user) {
    this.user = user;
    this.isSigned = true;
    return localStorage.setItem('user', JSON.stringify(user));
  }

  async setAuth(data) {
    await this.setToken(data.token, data.expires_in);
    return this.setUser(data.user);
  }

  async clearAuth() {
    this.isSigned = false;
    this.user = null;
    this.token = '';
    return this.clearLocalstorage();
  }

  async clearLocalstorage() {
    await localStorage.removeItem('user');
    await localStorage.removeItem('token');
    return localStorage.removeItem('expires');
  }

  async attemptAuthFromLocalStorage() {
    const expires = await localStorage.getItem('expires');
    if (new Date() / 1000 < expires) {
      return this.getAuthFromLocalStorage();
    }
    return this.clearLocalstorage();
  }

  async getAuthFromLocalStorage() {
      this.user = await JSON.parse(localStorage.getItem('user'));
      this.isSigned = !!this.user;
      this.token = await localStorage.getItem('token');
    }

}
export default new ApiService();
