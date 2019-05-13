<template lang="html">

  <section class="logout">
    <h1>logout Component</h1>
  </section>

</template>

<script lang="js">
  import popupContent from '../../mixins/popupContent';
  export default  {
    name: 'logout',
    props: [],
    mixins: [popupContent],
    async mounted() {
      const response = await this.apiService.logout();
      this.onSuccess(response);
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
  .logout {

  }
</style>
