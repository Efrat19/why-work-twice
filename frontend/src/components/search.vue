<template lang="html">
  <section class="search">
      <input type="text" class="wwt-input bar form-control" v-model="bar"
             @input="fetchResults()" :placeholder="`search ${resultType}s...`">
    <div class="results">
      <component :is="getResultType" v-for="(result,index) in results" :key="index" :result="result"></component>
    </div>
  </section>

</template>

<script lang="js">
  import apiService from '../services/apiService';
  import userSearchResult from './user-search-result';
  export default  {
    name: 'search',
    components: {
      userSearchResult,
    },
    props: {
      url: {
        type: String,
        required: true,
      },
      resultType: {
        type: String,
        required: true,
      }
    },
    mounted() {

    },
    data() {
      return {
        apiService,
        bar: '',
        results: [],
      }
    },
    methods: {
      async fetchResults(){
        const response = await this.apiService.api('get', `${this.url}?q=${this.bar}`);
        this.results = response.data;
      },
    },
    computed: {
      getResultType(){
        return `${this.resultType}SearchResult`;
      },
    }
}
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
