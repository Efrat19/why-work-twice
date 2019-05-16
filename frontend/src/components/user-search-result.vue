<template lang="html">
  <section class="user-search-result">
    <details>
      <summary>{{getSummary}}
        <router-link :to="`/user/${result.id}`">profile page</router-link>
      </summary>
      <pre>{{result}}</pre>
    </details>
  </section>
</template>

<script lang="js">
  import searchResult from '../mixins/searchResult';
  export default  {
    name: 'user-search-result',
    mixins: [searchResult],
    props: [],
    mounted() {
    },
    data() {
      return {

      }
    },
    methods: {

    },
    computed: {
      getSummary(){
        return `user: ${this.result.id}: ${this.result.name}, ${this.result.email}`;
      }
    }
}
</script>

<style scoped lang="scss">
  .user-search-result {
    background-color: white;
    border-radius: 6px;
    border: 1px solid black;
    padding: 10px;
    margin: 10px auto;
  }
</style>
