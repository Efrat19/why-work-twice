<template lang="html">
  <section class="search">
    <div class="bar">
      <input type="text" class="wwt-input" placeholder="" v-model="bar"  @input="fetchResults()">
    </div>
  </section>

</template>

<script lang="js">
  export default  {
    name: 'search',
    props: {
      url: {
        type: String,
        required: true,
      },
      url: {
        type: String,
        required: true,
      }
    },
    mounted() {

    },
    data() {
      return {
        bar:'',
      }
    },
    methods: {
      async fetchResults(){
        this.results = await this.apiService.api('get', '/admin/users');
      }
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .search {
    height: 800px;
    display: grid;
    grid-template-columns: auto;
    grid-template-rows: 15% auto;
    grid-gap: 0;
    grid-template-areas:
            "bar"
            "results ";
    .bar{
      grid-area: bar;
      margin: 15% auto;
    }
    .results{
      margin: 15% auto;
      grid-area: results;
    }
  }
</style>
