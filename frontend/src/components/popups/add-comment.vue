<template lang="html">

  <section class="add-comment">
    <form>
      <h4>{{editMode ? 'Edit ': 'Add '}} Comment</h4>
      <div class="form-group">
        <label for="header1">Header</label>
        <input type="text" class="form-control" id="header1" aria-describedby="emailHelp" placeholder="wtf" v-model="header">
      </div>
      <div class="form-group">
        <label for="body1">Body</label>
        <textarea class="form-control" id="body1" v-model="body" placeholder="drop it all here..."></textarea>
      </div>
      <button type="submit" class="btn btn-primary" @click.prevent="submit">Comment</button>
    </form>
  </section>

</template>

<script lang="js">
  import popupContent from '../../mixins/popupContent';
  export default  {
    name: 'add-comment',
    mixins: [popupContent],
    props: [],
    mounted() {
    },
    data() {
      return {
        header: '',
        body: '',
      };
    },
    methods: {
      async submit(){
        const form = {
          body: this.body,
          header: this.header,
          homeworkId: this.payload.homeworkId,
        };
        const uri = this.editMode ? `/comment/${this.payload.id}` : '/comment';
        try {
          const response = await this.apiService.api('post', uri, form);
          this.events.$emit('commentsUpdated');
          this.onSuccess(response.data);
        }
        catch (error) {
          this.onFailure(error);
        }
      },
      async getOld() {
        try {
          const old = await this.apiService.api('get', `/comment/${this.payload.id}`);
          this.header = old.header;
          this.body = old.body;
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
  .add-comment {

  }
</style>
