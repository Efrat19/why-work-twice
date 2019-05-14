<template lang="html">

  <section class="delete-comment">
    <h3>delete comment {{payload.id}}</h3>
    <h2>sure about that?</h2>
    <button class="btn btn-primary no" @click.prevent="close()">No, Cancel</button>
    <button class="btn btn-primary yes" @click.prevent="submit()">Yeah</button>
  </section>

</template>

<script lang="js">
  import popupContent from '../../mixins/popupContent';
  export default  {
    name: 'delete-comment',
    props: [],
    mixins: [popupContent],
    mounted() {

    },
    data() {
      return {

      }
    },
    methods: {
      async submit() {
        try {
          const response = await this.apiService.api('delete', `/comment/${this.payload.id}`);
          this.events.$emit('commentsUpdated');
          this.onSuccess(response.data);
        }
        catch (error) {
          this.onFailure(error);
        }
      }
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .delete-comment {
    .no{
      float: left;
    }
    .yes{
      float: right;
    }
  }
</style>
