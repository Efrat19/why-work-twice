<template >

  <section class="home">
    <h1>home Component</h1>
    <popular-subject v-for="subject in popularSubjects"
                     :subject="subject.subject"
                     :homeworks-num="subject.homeworksNum"
                     :users-num="subject.usersNum"></popular-subject>
    <!--<search url="/search/homeworks" result-type="homework"></search>-->
    <search-bar result-type="homework" url="/search/homeworks" @searchInput="freeSearch"></search-bar>
    <button class="wwt-btn" @click="toggleSmartSearch">smart search</button>
    <smart-search v-if="useSmartSearch" @smartSearchGo="smartSearch" :filters="filters"></smart-search>
    <homework-search-result v-for="(result,index) in results" :key="index" :result="result"></homework-search-result>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>
</template>

<script>
  import _ from 'lodash';
import searchBar from './search-bar.vue';
import smartSearch from './smart-search.vue';
import apiService from '../services/apiService';
import homeworkSearchResult from './homework-search-result.vue';
import popularSubject from './popular-subject.vue';

export default {
  name: 'home',
  props: [],
  components: {
    // search,
    smartSearch,
    searchBar,
    homeworkSearchResult,
    popularSubject,
  },
  mounted() {
    this.getPopularSubjects();
  },
  data() {
    return {
      error: 0,
      apiService,
      filters: [],
      results: [],
      popularSubjects: [],
      useSmartSearch: false,
    };
  },
  methods: {
    async freeSearch(url) {
      try {
        const response = await this.apiService.api('get', url);
        this.results = response.data;
      } catch (e) {
        this.onFailure(e);
      }
    },
    async getFilters() {
      try {
        const response = await this.apiService.api('get', '/smart-search/filters');
        this.filters = response.data;
      } catch (e) {
        this.onFailure(e);
      }
    },
    async smartSearch(selctedFilters) {
      try {
        const response = await this.apiService.api('post', '/smart-search/results', {filters: selctedFilters});
        this.results = response.data;
      } catch (e) {
        this.onFailure(e);
      }
    },
    async getPopularSubjects() {
      try {
        const response = await this.apiService.api('get', '/popular-subjects');
        this.popularSubjects = response.data;
      } catch (e) {
        this.onFailure(e);
      }
    },
    onFailure(error) {
      this.error = error.response && error.response.status;
    },
    async toggleSmartSearch() {
      if (!this.filters.length) {
        await this.getFilters();
      }
      this.useSmartSearch = !this.useSmartSearch;
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .home {

  }
</style>
