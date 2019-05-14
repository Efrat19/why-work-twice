<template lang="html">

  <section class="delete-homework">
    <h3>delete comment {{payload.id}}</h3>
    <h2>sure about that?</h2>
    <button class="btn btn-primary no" @click.prevent="close()">No, Cancel</button>
    <button class="btn btn-primary yes" @click.prevent="submit()">Yeah</button>
  </section>

</template>

<script lang="js">
  import popupContent from '../../mixins/popupContent';

  export default {
    mixins: [popupContent],
    name: 'delete-homework',
    props: [],
    mounted() {

    },
    data() {
      return {

      }
    },
    methods: {
      async submit() {
        try {
          const response = await this.apiService.api('delete', `/homework/${this.payload.id}`);
          this.events.$emit('homeworkUpdated', response.data.id);
          this.onSuccess(response.data);
        } catch (error) {
          this.onFailure(error);
        }
      }
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .delete-homework {

  }
</style>
