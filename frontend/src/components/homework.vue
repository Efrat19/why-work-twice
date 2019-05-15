<template lang="html">

  <section class="homework">
    <div class="grid" v-if="profile">
      <div class="desc"><h3>{{profile.description}}</h3></div>
      <div class="options">
        <div class="edit" v-if="profile.canEdit">
          <i class="fas fa-edit" @click="open('add-homework',{editMode: true, id: profile.id})"></i></div>
        <div class="delete" v-if="profile.canDelete">
          <i class="fas fa-trash-alt" @click="open('delete-homework',{id: profile.id})"></i>
        </div>
      </div>
      <div class="love" @click="toggleLove(!profile.loved)">
        profile.loved {{profile.loved}}
        <i :class="profile.loved ? 'fas fa-heart': 'far fa-heart'"></i>
      </div>
        <hw-card class="hw-card" :profile="profile"></hw-card>
      <detail class="comment-header" keyName="comment" :value="profile.commentsNum"></detail>
      <div class="add">
        <i class="fas fa-plus"  @click="open('add-comment',{homeworkId: id})"></i>
      </div>
      <div class="comments">
        <comment v-for="(comment,index) in comments" :comment="comment" :key="index"></comment>
      </div>
      <div class="more" v-if="profile.commentsNum > comments_limit" @click="showMore()">Show More</div>
    </div>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script lang="js">
  import hwCard from './hw-card.vue';
  import comment from './comment.vue';
  import apiService from '../services/apiService';
  import openPopup from '../mixins/openPopup';
  import detail from './detail.vue';
  import events from '../events';
  export default {
    name: 'homework',
    mixins: [openPopup],
    components: {
      comment,
      hwCard,
      detail,
    },
    data() {
      return {
        apiService,
        profile: null,
        comments: [],
        comments_limit: 5,
        events,
        UNLIMITED: -1,
        error: '',
      };
    },
    beforeMount() {
      this.events.$on('commentUpdated', () => this.getComments(this.UNLIMITED));
      this.events.$on('homeworkUpdated', id => id === this.id && this.getProfile());
    },
    mounted() {
      this.id = parseInt(this.$route.params.id, 10);
      this.getProfile();
      this.getComments(this.comments_limit);
    },
    methods: {
      showMore() {
        this.comments_limit += this.comments_limit;
        this.getComments(this.comments_limit);
      },
      async getProfile() {
        try{
          const response = await this.apiService.api('get', `/homework/${this.id}`);
          this.profile = response.data;
          this.error = '';
        }
        catch (e) {
          this.onFailure(e);
        }
      },
      async getComments(limit) {
        const response = await this.apiService.api('get', `/homework/${this.id}/comments/${limit}`);
        this.comments = response.data;
      },
      async toggleLove(love) {
        const response = await this.apiService.api('get', `/homework/${this.id}/favorite/${love}`);
        this.profile.loved = response.data;
      },
      onFailure(error){
        this.error = error.response.status;
      }
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .homework {
    .grid{
      width: 100%;
      display: grid;
      grid-template-columns: auto;
      grid-template-rows:50px 350px auto 20px;
      grid-gap: 0;
      grid-template-areas:
              "desc options love"
              "hw-card hw-card hw-card"
              "comment-header add add"
              "comments comments comments"
              "more more more";
      .comments{
        grid-area: comments;
      }
      .hw-card{
        grid-area: hw-card;
      }
      .more{
        grid-area: more;
        cursor: pointer;
      }
      .love{
        grid-area: love;
        cursor: pointer;
      }
      .options{
        grid-area: options;
        cursor: pointer;
      }
      .comment-header{
        grid-area: comment-header;
      }
      .add{
        grid-area: add;
        cursor: pointer;
      }
    }
  }
</style>
