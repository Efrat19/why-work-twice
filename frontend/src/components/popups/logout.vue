<template >

  <section class="logout">
    <h1>logout Component</h1>
  </section>

</template>

<script >
import popupContent from '../../mixins/popupContent';

export default {
  name: 'logout',
  props: [],
  mixins: [popupContent],
  async mounted() {
    try {
      const response = await this.apiService.api('get', '/logout');
      await this.apiService.clearAuth();
      this.onSuccess(response.data);
    } catch (error) {
      this.onFailure(error);
    }
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
  .logout {

  }
</style>
