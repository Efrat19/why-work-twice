<template lang="html">

  <section class="homework">
    <div class="grid" v-if="profile">
      <div class="desc"><h3>{{profile.description}}</h3></div>
      <div class="love" @click="toggleLove(!profile.loved)">
        <i :class="profile.loved ? 'fas fa-heart': 'far fa-heart'"></i>
      </div>
      <div class="hw-card">
        <hw-card :profile="profile"></hw-card>
      </div>
      <detail class="comment-header" keyName="comment" :value="profile.commentsNum"></detail>
      <div class="add">
        <i class="fas fa-plus"  @click="open('add-comment',{homeworkId: id})"></i>
      </div>
      <div class="comments">
        <comment v-for="(comment,index) in comments" :comment="comment" :key="index"></comment>
      </div>
      <div class="more" v-if="profile.commentsNum > comments_limit" @click="showMore()">Show More</div>
    </div>
  </section>

</template>

<script lang="js">
  import hwCard from './hw-card.vue';
  import comment from './comment.vue';
  import apiService from '../services/apiService';
  import openPopup from '../mixins/openPopup';
  import detail from './detail.vue';
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
        love: false,
      };
    },
    mounted() {
      this.id = this.$route.params.id;
      this.getHWProfile();
      this.getComments();
    },
    methods: {
      showMore(){
        this.comments_limit += this.comments_limit;
        this.getComments();
      },
      async getHWProfile(){
        this.profile = await this.apiService.getHwProfile(this.id);
        this.love = this.profile.loved;
      },
      async getComments(){
        this.comments = await this.apiService.getComments(this.id, this.comments_limit);
      },
      async toggleLove(love){
        this.love = await this.apiService.toggleLove(this.id, love);
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
              "desc desc love"
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
