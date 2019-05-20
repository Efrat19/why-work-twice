<template lang="html">

  <section class="user">
      <div class="grid" v-if="profile">
        <div class="desc"><h3>{{profile.description}}</h3></div>
        <user-card class="user-card" :profile="profile"></user-card>
        <div  class="homework-header" >
          <detail keyName="uploads" :value="profile.uploads"></detail>
          <div class="homeworks">
          </div>
          <hw-card v-for="(homework,index) in homeworks" :profile="homework" :key="index"></hw-card>
        </div>
        <div class="more wwt-btn" v-if="profile.uploads > homeworksLimit" @click="showMore()">Show More</div>
      </div>
      <div class="wwt-status" v-if="error">
        {{error}}
    </div>
  </section>

</template>

<script lang="js">
  import events from '../events';
  import openPopup from '../mixins/openPopup';
  import apiService from '../services/apiService';
  import userCard from './user-card.vue';
  import hwCard from "./hw-card";
  import detail from './detail.vue';
  export default  {
    name: 'user',
    props: {
      id : {
        type: Number,
        required: true,
      }
    },
    mixins: [openPopup],
    components: {
      hwCard,
      userCard,
      detail
    },
    beforeMount() {
      this.events.$on('homeworkUpdated', () => this.getHomeworks(this.UNLIMITED));
    },
    mounted() {
      this.getProfile();
      this.getHomeworks(this.comments_limit);
    },
    data() {
      return {
        apiService,
        profile: null,
        homeworks: [],
        homeworksLimit: 5,
        events,
        UNLIMITED: -1,
        error: '',
      };
    },
    methods: {
      async getProfile() {
        try{
          const response = await this.apiService.api('get', `/user/${this.id}`);
          this.profile = response.data;
          this.error = '';
        }
        catch (e) {
          this.onFailure(e);
        }
      },
      onFailure(error){
        this.error = error.response.status;
      },
      showMore() {
        this.homeworksLimit += this.homeworksLimit;
        this.getComments(this.homeworksLimit);
      },
      async getHomeworks(limit) {
        const response = await this.apiService.api('get', `/user/${this.id}/homeworks/${limit}`);
        this.comments = response.data;
      },
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .user {
    .grid{
      width: 100%;
      display: grid;
      grid-template-rows:50px 350px auto 20px;
      grid-gap: 30px;
      grid-template-areas:
              "desc"
              "user-card"
              "homework-header"
              "homeworks"
              "more";
      .homeworks{
        grid-area: homeworks;
      }
      .user-card{
        grid-area: user-card;
      }
      .more {
        grid-area: more;
        cursor: pointer;
        margin-bottom: 100px;
        width: 30%;
        margin-right: auto;
        margin-left: auto;
      }
      .homework-header{
        grid-area: homework-header;
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
