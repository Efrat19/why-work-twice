import axios from 'axios';
import store from '../store';
import router from '../router';

class ApiService {
  constructor() {
    this.store = store;
    this.axios = axios;
    this.router = router;
    this.baseUrl = 'http://localhost:8000/api';
    this.user = null;
    this.isSigned = false;
    this.token = '';
    this.firstRequest = true;
  }

  async api(method, uri, data) {
    if (this.firstRequest) {
      await this.attemptAuthFromLocalStorage();
      this.firstRequest = false;
    }
    return this.axios.create({
      baseURL: this.baseUrl,
      headers: { Authorization: `Bearer ${this.token}` },
    })[method](uri, data);
  }

  async setToken(token, expires) {
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
