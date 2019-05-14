import ApiService from './apiService';

class HomeworkService extends ApiService {

  constructor() {
    super();
  }

  async getHwProfile(hwId) {
    const response = await this.axios.get(`${this.baseUrl}/homework/${hwId}`);
    return response.data;
  }


  async toggleLove(hwId, love) {
    const response = await this.axios.get(`${this.baseUrl}/homework/${hwId}/favorite/${love}${this.getAuthSuffix()}`);
    return response.data;
  }

}
export default new HomeworkService();
