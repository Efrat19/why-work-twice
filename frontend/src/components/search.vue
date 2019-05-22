<template >
  <section class="search">
      <search-bar :url="url" @searchInput="fetchResults" :result-type="resultType"></search-bar>
    <div class="results">
      <component :is="getResultType" v-for="(result,index) in results" :key="index" :result="result"></component>
    </div>
  </section>

</template>

<script >
import apiService from '../services/apiService';
import searchBar from './search-bar.vue';
import userSearchResult from './user-search-result';
import commentSearchResult from './comment-search-result';
import homeworkSearchResult from './homework-search-result';

export default {
  name: 'search',
  components: {
    searchBar,
    userSearchResult,
    commentSearchResult,
    homeworkSearchResult,
  },
  props: {
    url: {
      type: String,
      required: true,
    },
    resultType: {
      type: String,
      required: true,
    },
  },
  mounted() {

  },
  data() {
    return {
      apiService,
      results: [],
    };
  },
  methods: {
    async fetchResults(url) {
      const response = await this.apiService.api('get', url);
      this.results = response.data;
    },
  },
  computed: {
    getResultType() {
      return `${this.resultType}SearchResult`;
    },
  },
};
</script>

<style scoped lang="scss">
  .search {
    display: grid;
    grid-template-columns: auto;
    grid-template-rows: 100px auto;
    grid-gap: 0;
    grid-template-areas:
            "bar"
            "results ";
    .bar{
      grid-area: bar;
      margin: 5% auto;
    }
    .results{
      margin: 0 auto;
      grid-area: results;
    }
  }
</style>
