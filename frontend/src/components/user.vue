<template lang="html">

  <section class="user">
    <h1>user Component</h1>
  </section>

</template>

<script lang="js">
  export default  {
    name: 'user',
    props: [],
    mounted() {
      this.id = this.$route.params.id;
    },
    data() {
      return {
        id: false,
      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .user {

  }
</style>
