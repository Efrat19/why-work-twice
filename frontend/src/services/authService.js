
import ApiService from './apiService';

class AuthService extends ApiService{

  constructor() {
    super();
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

}
export default new AuthService();
