<template >
  <section class="homework">
    <details>
      <summary>{{getSummary}}
        <router-link :to="`/homework/${result.id}`">view page</router-link>
      </summary>
      <pre>{{result}}</pre>
    </details>
  </section>
</template>

<script >
import searchResult from '../mixins/searchResult';

export default {
  name: 'homework-search-result',
  mixins: [searchResult],
  props: [],
  mounted() {
  },
  data() {
    return {

    };
  },
  methods: {

  },
  computed: {
    getSummary() {
      return `homework: ${this.result.id}: ${this.result.user.name}`;
    },
  },
};
</script>

<style scoped lang="scss">
  @import "../assets/scss_mixins";
  .homework {
    @include shadow();
    background-color: white;
    border-radius: 6px;
    padding: 10px;
    margin: 10px auto;
  }
</style>
