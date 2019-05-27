<template >

  <section class="admin">
    <h1>admin panel</h1>
    <search-bar v-if="getSearchAction" @searchInput="getAdminPage" result-type="user" url="getSearchAction"></search-bar>
    <div class="page" v-if="page" v-html="page"></div>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script >
import apiService from '../services/apiService';
import searchBar from './search-bar';

export default {
  name: 'admin',
  props: [],
  components: {
    searchBar,
  },
  beforeMount() {
    window.getAdminPage = this.getAdminPage;
  },
  mounted() {
    this.getAdminPage('/');
  },
  data() {
    return {
      apiService,
      page: false,
      error: 0,
      searchBaseUrl: '/admin/search',
      resultType: 'user',
    };
  },
  methods: {
    async getAdminPage(url) {
      console.log(url);
      try {
        const response = await this.apiService.api('get', `/admin${url}`);
        this.page = response.data;
        this.error = '';
      } catch (e) {
        this.onFailure(e);
      }
    },
    onFailure(error) {
      this.error = (error.response && error.response.status) || 500;
    },
    search(query) {
      this.getAdminPage(`/search/${this.resultType}s?q=${query}`);
    },
  },
  computed: {
    getSearchAction() {
      return window.searchAction;
    },
  },
};
</script>

<style scoped lang="scss">
  .admin {

  }
</style>
