import ApiService from './apiService';

class CommentService extends ApiService {
  constructor() {
    super();
  }

  async getComments(hwId, commentsLimit) {
    const response = await this.axios.get(`${this.baseUrl}/homework/${hwId}/comments/${commentsLimit}${this.getAuthSuffix()}`);
    return response.data;
  }

  async createComment(form, homeworkId) {
    const response = await this.axios.post(`${this.baseUrl}/comment${this.getAuthSuffix()}`, {
      homeworkId,
      ...form
    });
    return response.data;
  }

  async updateComment(id, form, homeworkId) {
    const response = await this.axios.put(`${this.baseUrl}/comment/${id}${this.getAuthSuffix()}`, {
      homeworkId,
      ...form
    });
    return response.data;
  }

  async getOldComment(id) {
    const response = await this.axios.get(`${this.baseUrl}/comment/${id}${this.getAuthSuffix()}`);
    return response.data;
  }

  async deleteComment(id) {
    const response = await this.axios.delete(`${this.baseUrl}/comment/${id}${this.getAuthSuffix()}`);
    return response.data;
  }

}
export default new CommentService();
