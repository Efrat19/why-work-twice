<template >

  <section class="navbar">
    <router-link class="home wwt-link" to="/">Home</router-link>
    <div class="upload"><button  class="wwt-btn" @click="open('add-homework')">Add Your Homework</button></div>
    <div class="auth">
      <router-link v-if="auth" class="home wwt-link" :to="`/user/${apiService.user.id}`">Me</router-link>
      <button v-if="auth" class="logout wwt-btn" @click="open('logout')">Logout</button>
      <button v-if="!auth" class="register wwt-btn" @click="open('register')">Register</button>
      <button v-if="!auth" class="login wwt-btn" @click="open('login')">Login</button>
    </div>
  </section>

</template>

<script >
import openPopup from '../mixins/openPopup';
import apiService from '../services/apiService';

export default {
  name: 'navbar',
  mixins: [openPopup],
  props: {
  },
  mounted() {

  },
  data() {
    return {
      apiService,
    };
  },
  methods: {

  },
  computed: {
    auth() {
      return this.apiService.isSigned;
    },
  },
};
</script>

<style scoped lang="scss">
    @import "../assets/scss_mixins";
  .navbar {
      @include shadow();
    background-color: white;
    display: grid;
    grid-template-columns: 15% 15% auto 25%;
    grid-template-rows: auto;
    grid-gap: 0;
    grid-template-areas:
            "home upload space auth";
    .home{
      grid-area: home;
    }
    .auth{
      grid-area: auth;
    }
    .upload{
      grid-area: upload;
    }
    .space{
      grid-area: space;
    }
  }
</style>
