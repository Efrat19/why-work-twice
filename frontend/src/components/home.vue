<template >

  <section class="home">
    <h1>home Component</h1>
    <search url="/search/homeworks" result-type="homework"></search>
  </section>

</template>

<script>
  import search from './search.vue';
export default {
  name: 'home',
  props: [],
  components: {
    search,
  },
  mounted() {

  },
  data() {
    return {

    };
  },
  methods: {

  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .home {

  }
</style>
