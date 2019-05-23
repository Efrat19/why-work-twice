<template >
  <div class="site">
      <div class="grid">
          <navbar class="navbar"></navbar>
          <div class="left-space"></div>
          <router-view class="view"></router-view>
          <div class="right-space"></div>
      </div>
      <popup v-if="store.getters.isOpen" :name="store.getters.popupName"></popup>
  </div>
</template>

<script >
import navbar from './navbar.vue';
import popup from './popup.vue';
import apiService from '../services/apiService';
import store from '../store';
import events from '../events';

export default {
  name: 'site',
  props: [],
  components: {
    navbar,
    popup,
  },
  data() {
    return {
      apiService,
      store,
      events,
    };
  },
  beforeMount() {
    this.events.$on('homeworkUpdated', id => this.$router.push(`/homework/${id}`));
    this.events.$on('userUpdated', id => this.$router.push(`/user/${id}`));
    this.events.$on('logout', () => this.$router.push('/'));
  },
  mounted() {
    // this.apiService.login();
  },
  methods: {

  },
  computed: {

  },
};
</script>

<style scoped lang="scss">


  .site {
      width: 100%;
      background-color: #cecece;
   .grid{
       width: 100%;
       margin: 0;
       display: grid;
       grid-template-columns: 27% auto 27%;
       grid-template-rows: 30px auto;
       grid-gap: 0;
       grid-template-areas:
               "nav nav nav"
               "left-space view right-space";
       .navbar{
           grid-area: nav;
       }
       .view{
           margin-top: 7%;
           grid-area: view;
       }
       .right-space{
           grid-area: right-space;
       }
       .left-space{
           grid-area: left-space;
       }
   }
  .popup{
      position: absolute;
      margin: 0;
      top: 0;
      width: 100%;
      z-index: 10;
  }
  }
</style>
