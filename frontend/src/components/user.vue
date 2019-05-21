<template >

  <section class="user">
      <div class="grid" v-if="profile">
        <div class="desc"><h3>{{profile.name}}</h3></div>
        <user-card class="user-card" :profile="profile"></user-card>
        <div  class="homework-header" >
          <div class="homeworks">
              <hw-box class="box" v-for="(homework,index) in homeworks" :homework="homework" :key="index"></hw-box>
          </div>
        </div>
        <div class="more wwt-btn" v-if="profile.uploads > homeworksLimit" @click="showMore()">Show More</div>
      </div>
      <div class="wwt-status" v-if="error">
        {{error}}
    </div>
  </section>

</template>

<script >
import events from '../events';
import openPopup from '../mixins/openPopup';
import apiService from '../services/apiService';
import userCard from './user-card.vue';
import hwBox from './hw-box.vue';

export default {
  name: 'user',
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  mixins: [openPopup],
  components: {
    userCard,
    hwBox,
  },
  beforeMount() {
    this.events.$on('homeworkUpdated', () => this.getHomeworks(this.UNLIMITED));
  },
  mounted() {
    this.getProfile();
    this.getHomeworks(this.homeworksLimit);
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
      try {
        const response = await this.apiService.api('get', `/user/${this.id}`);
        this.profile = response.data;
        this.error = '';
      } catch (e) {
        this.onFailure(e);
      }
    },
    onFailure(error) {
      this.error = error.response.status;
    },
    showMore() {
      this.homeworksLimit += this.homeworksLimit;
      this.getComments(this.homeworksLimit);
    },
    async getHomeworks(limit) {
      const response = await this.apiService.api('get', `/user/${this.id}/homeworks/${limit}`);
      this.homeworks = response.data;
    },
  },
  computed: {

  },
};
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
          .box {
              margin: 10px;
              display: inline-block;
          }
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
