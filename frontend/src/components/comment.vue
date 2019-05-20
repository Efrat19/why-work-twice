<template >

  <section class="comment">
    <div class="header">{{comment.header}} {{comment.id}}</div>
    <div class="edit" v-if="comment.canEdit">
      <i class="fas fa-edit" @click="open('add-comment',{editMode: true, id: comment.id})"></i></div>
    <div class="delete" v-if="comment.canDelete">
      <i class="fas fa-trash-alt" @click="open('delete-comment',{id: comment.id})"></i>
    </div>
    <div class="body">{{comment.body}}</div>
    <div class="author">{{getAuthorDetails()}}</div>
  </section>

</template>

<script >
import openPopup from '../mixins/openPopup';
import store from '../store';

export default {
  name: 'comment',
  mixins: [openPopup],
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
  mounted() {

  },
  data() {
    return {
      store,
    };
  },
  methods: {
    getAuthorDetails() {
      const isUpdated = this.comment.created_at !== this.comment.updated_at;
      return `commented by ${this.comment.user.name} on ${this.comment.created_at}${isUpdated ? `, last updated at ${this.comment.updated_at}` : ''}`;
    },
  },
  computed: {
  },
};
</script>

<style scoped lang="scss">
  @import "../assets/scss_mixins";
  .comment {
    @include shadow();
    display: grid;
    grid-template-areas:
            "header edit delete"
            "body body body"
            "author author author";
    grid-template-columns: auto 4% 4%;
    grid-template-rows: 25px auto 15px;
    background-color: white;
    border-radius: 6px;
    padding: 10px;
    margin: 10px auto;
    .header{
      grid-area: header;
      font-size: 2rem;
    }
    .edit{
      grid-area: edit;
      font-size: 1.7rem;
        cursor: pointer;
    }
    .delete{
      grid-area: delete;
      font-size: 1.7rem;
        cursor: pointer;
    }
    .body{
      grid-area: body;
      font-size: 1.7rem;
    }
    .author{
      grid-area: author;
      font-size: 1.3rem;
    }
  }
</style>
