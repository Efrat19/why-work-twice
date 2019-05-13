import Vue from "vue";
import axios from "axios";
import store from "../store";
import router from "../router";

class ApiService {
  constructor() {
    this.axios = axios;
    this.store = store;
    this.router = router;
    this.baseUrl = "http://localhost:8000/api";
    this.jwt = '';
  }
  setUser({ user }) {
    this.store.dispatch("setIsSigned", !!user);
    this.store.dispatch("setUser", user);
  }
  async register(form) {
    const response = await axios.post(`${this.baseUrl}/register`, form);
    this.setUser(response.data);
    this.jwt = response.data.access_token;
    // this.storeToken(this.jwt);
  }
  async login(form) {
    const response = await axios.post(`${this.baseUrl}/login`, form);
    this.setUser(response.data);
    this.jwt = response.data.token;
    // this.storeToken(this.jwt);
  }
  async logout() {
    const response = await axios.get(`${this.baseUrl}/restricted/test?token=${this.jwt}`, {},{
     headers: {
      Authorization: `Bearer ${this.jwt}`
     }
    });
    this.setUser(response.data);
    this.jwt = '';
  }
  async getHwProfile(hwId) {
    const response = await axios.get(`${this.baseUrl}/homework/${hwId}`);
    return response.data;
  }
  async getComments(hwId, commentsLimit) {
    const response = await axios.get(`${this.baseUrl}/homework/${hwId}/comments/${commentsLimit}`);
    return response.data;
  }
  async toggleLove(hwId, love) {
    const response = await axios.get(`${this.baseUrl}/homework/${hwId}/favorite/${love}`);
    return response.data;
  }
  async createComment(form, homeworkId) {
    const response = await axios.post(`${this.baseUrl}/comment/`, {
      homeworkId,
      ...form
    });
    return response.data;
  }
  async updateComment(id, form, homeworkId) {
    const response = await axios.put(`${this.baseUrl}/comment/${id}`, {
      homeworkId,
      ...form
    });
    return response.data;
  }
  async getOldComment(id) {
    const response = await axios.get(`${this.baseUrl}/comment/${id}`);
    return response.data;
  }
  async deleteComment(id) {
    const response = await axios.delete(`${this.baseUrl}/comment/${id}`);
    return response.data;
  }
  async storeToken(token){
      const prepare = token.split('.')[0].replace('-','+').replace('_','/');
      const decoded = JSON.parse(atob(prepare));
      console.log(decoded);
      debugger;
  }
  async getAuth(){
    return {
      headers: new Headers({
        Authorization: `Bearer: ${this.jwt}`
      })
    }
  }
}
export default new ApiService();
