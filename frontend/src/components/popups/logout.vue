<template lang="html">

  <section class="logout">
    <div v-if="!response">logging you out...</div>
    < <div v-if="response" class="msg">{{response}}</div>
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
