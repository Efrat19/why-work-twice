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
    await this.store.dispatch('setIsSigned', true);
    await this.store.dispatch('setUser', data.user);
    return this.store.dispatch('setToken', data.token);
  }

  async clearAuth() {
    await this.store.dispatch('setIsSigned', false);
    await this.store.dispatch('setUser', null);
    return this.store.dispatch('setToken', '');
  }

  // async register(form) {
  //   const response = await this.axios.post(`${this.baseUrl}/register`, form);
  //   this.setAuth(response.data);
  // }
  //
  // async login(form) {
  //   const response = await this.axios.post(`${this.baseUrl}/login`, form);
  //   this.setAuth(response.data);
  // }
  //
  // async logout() {
  //   const response = await this.axios.get(`${this.baseUrl}/logout${this.getAuthSuffix()}`);
  //   this.setAuth(response.data);
  // }

  async api(method, uri, data){
    const url = this.baseUrl + uri + this.getAuthSuffix();
    return this.axios[method](url, data);
  }
  // async getHwProfile(hwId) {
  //   const response = await axios.get(`${this.baseUrl}/homework/${hwId}`);
  //   return response.data;
  // }
  // async getComments(hwId, commentsLimit) {
  //   const response = await axios.get(`${this.baseUrl}/homework/${hwId}/comments/${commentsLimit}`);
  //   return response.data;
  // }
  // async toggleLove(hwId, love) {
  //   const response = await axios.get(`${this.baseUrl}/homework/${hwId}/favorite/${love}`);
  //   return response.data;
  // }
  // async createComment(form, homeworkId) {
  //   const response = await axios.post(`${this.baseUrl}/comment/`, {
  //     homeworkId,
  //     ...form
  //   });
  //   return response.data;
  // }
  // async updateComment(id, form, homeworkId) {
  //   const response = await axios.put(`${this.baseUrl}/comment/${id}`, {
  //     homeworkId,
  //     ...form
  //   });
  //   return response.data;
  // }
  // async getOldComment(id) {
  //   const response = await axios.get(`${this.baseUrl}/comment/${id}`);
  //   return response.data;
  // }
  // async deleteComment(id) {
  //   const response = await axios.delete(`${this.baseUrl}/comment/${id}`);
  //   return response.data;
  // }
  // async storeToken(token){
  //     const prepare = token.split('.')[0].replace('-','+').replace('_','/');
  //     const decoded = JSON.parse(atob(prepare));
  //     console.log(decoded);
  //     debugger;
  // }
  // async getAuth(){
  //   return {
  //     headers: new Headers({
  //       Authorization: `Bearer: ${this.jwt}`
  //     })
  //   }
  // }
}
export default new ApiService();
