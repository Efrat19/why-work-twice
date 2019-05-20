<template >

  <section class="homework">
    <div class="grid" v-if="profile">
      <div class="desc"><h3>{{profile.description}}</h3></div>
        <hw-card class="hw-card" :profile="profile"></hw-card>
      <div  class="comment-header" >
        <detail keyName="comment" :value="profile.commentsNum"></detail>
        <i class="add fas fa-plus"  @click="open('add-comment',{homeworkId: id})"></i>
        <div class="comments">
      </div>
        <comment v-for="(comment,index) in comments" :comment="comment" :key="index"></comment>
      </div>
      <div class="more wwt-btn" v-if="profile.commentsNum > comments_limit" @click="showMore()">Show More</div>
    </div>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script >
import hwCard from './hw-card.vue';
import comment from './comment.vue';
import apiService from '../services/apiService';
import openPopup from '../mixins/openPopup';
import detail from './detail.vue';
import events from '../events';

export default {
  name: 'homework',
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
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
    this.getProfile();
    this.getComments(this.comments_limit);
  },
  methods: {
    showMore() {
      this.comments_limit += this.comments_limit;
      this.getComments(this.comments_limit);
    },
    async getProfile() {
      try {
        const response = await this.apiService.api('get', `/homework/${this.id}`);
        this.profile = response.data;
        this.error = '';
      } catch (e) {
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
    onFailure(error) {
      this.error = error.response.status;
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .homework {
    .grid{
      width: 100%;
      display: grid;
      grid-template-rows:50px 350px auto 20px;
      grid-gap: 30px;
      grid-template-areas:
              "desc"
              "hw-card"
              "comment-header"
              "comments"
              "more";
      .comments{
        grid-area: comments;
      }
      .hw-card{
        grid-area: hw-card;
      }
      .more {
        grid-area: more;
        cursor: pointer;
        margin-bottom: 100px;
        width: 30%;
        margin-right: auto;
        margin-left: auto;
      }
      .comment-header{
        grid-area: comment-header;
        .add{
          grid-area: add;
          cursor: pointer;
          margin-right: auto;
          font-size: 2rem;
        }
      }
    }
  }
</style>
