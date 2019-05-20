<template lang="html">
  <section class="comment-search-result">
    <details>
      <summary>{{getSummary}}
        <router-link :to="`/comment/${result.homework.id}`">view page</router-link>
      </summary>
      <pre>{{result}}</pre>
    </details>
  </section>
</template>

<script lang="js">
  import searchResult from '../mixins/searchResult';
  export default  {
    name: 'comment-search-result',
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
        return `comment: ${this.result.id}: on post ${this.homework.id}, written by ${this.result.user.id}`;
      }
    }
}
</script>

<style scoped lang="scss">
  @import "../assets/scss_mixins";
  .comment-search-result {
    @include shadow();
    background-color: white;
    border-radius: 6px;
    padding: 10px;
    margin: 10px auto;
  }
</style>
