<template lang="html">

  <section class="search-bar">
    <h1>search-bar Component</h1>
  </section>

</template>

<script lang="js">
  export default  {
    name: 'search-bar',
    props: {
      url: {
        type: String,
        required: true,
      }
    },
    mounted() {

    },
    data() {
      return {

      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .search-bar {

  }
</style>
