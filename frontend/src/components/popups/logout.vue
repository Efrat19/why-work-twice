<template >

  <section class="logout">
    <h2>logging you out...</h2>
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
      this.events.$emit('userUpdated', response.data.user.id);
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
