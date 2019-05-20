<template >

  <section class="admin">
    <h1>admin page</h1>
    <details>
      <summary>Users</summary>
      <search :url="`${searchBaseUrl}/users`" result-type="user"></search>
    </details>
    <details>
      <summary>Homeworks</summary>
      <search :url="`${searchBaseUrl}/homeworks`" result-type="homework"></search>
    </details>
    <details>
      <summary>Comments</summary>
      <search :url="`${searchBaseUrl}/comments`" result-type="comment"></search>

    </details>

    <div class="page" v-if="page" v-html="page"></div>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script >
import apiService from '../services/apiService';
import search from './search';

export default {
  name: 'admin',
  props: [],
  components: {
    search,
  },
  mounted() {
    this.getAdminPage();
  },
  data() {
    return {
      apiService,
      page: false,
      error: 0,
      searchBaseUrl: '/admin/search',
    };
  },
  methods: {
    async getAdminPage() {
      try {
        const response = await this.apiService.api('get', '/admin/');
        this.page = response.data;
        this.error = '';
      } catch (e) {
        this.onFailure(e);
      }
    },
    onFailure(error) {
      this.error = error.response.status;
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .admin {

  }
</style>
