<template lang="html">

  <section class="navbar">
    <router-link class="home" to="/">Home</router-link>
    <div class="upload"><button @click="open('add-homework')">Add Your Homework</button></div>
    <div class="auth">
      <router-link v-if="auth" class="home" to="/user">User</router-link>
      <button v-if="auth" class="logout" @click="open('logout')">Logout</button>
      <button v-if="!auth" class="register" @click="open('register')">Register</button>
      <button v-if="!auth" class="login" @click="open('login')">Login</button>
    </div>
  </section>

</template>

<script lang="js">
  import openPopup from '../mixins/openPopup'
  export default  {
    name: 'navbar',
    mixins:[openPopup],
    props: {
      auth: {
        type: Boolean,
        default: false,
      }
    },
    mounted() {

    },
    data() {
      return {

      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .navbar {
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
