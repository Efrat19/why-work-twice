<template lang="html">

  <section class="add-comment">
     <div v-if="response" class="msg">{{response}}</div>
     <form v-if="!response">
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
  import commentService from '../../services/commentService';
  export default  {
    name: 'add-comment',
    mixins: [popupContent],
    props: [],
    mounted() {
    },
    data() {
      return {
        commentService,
        header: '',
        body: '',
      };
    },
    methods: {
      async submit(){
        const form = {
          body: this.body,
          header: this.header,
        };
        const response = this.editMode ? await this.commentService.updateComment(this.payload.id, form, this.payload.homeworkId) :
                await this.commentService.createComment(form, this.payload.homeworkId);
        this.onSuccess(response);
      },
      async getOld(){
          const old = await this.commentService.getOldComment(this.payload.id);
          this.header = old.header;
          this.body = old.body;
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
