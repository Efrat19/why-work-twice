<template lang="html">
  <div class="popup">
    <div class="page">
      <component :is="name"></component>
    </div>
    <div class="cover"></div>
  </div>
</template>

<script lang="js">
  import signin from './popups/signin.vue';
  import signup from './popups/signup.vue';
  export default  {
    name: 'popup',
    props: {
       name: {
         type: String,
         required: true,
       }
    },
    components: {
      signin,
      signup,
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
  .popup {
    position: relative;
    .cover{
      position: absolute;
      z-index: 20;
      background-color: black;
      width: 100%;
      height: 1000px;
      opacity: 0.7;
    }
    .page{
      z-index: 30;
      background-color: white;
      top: 30%;
      left: 30%;
      border-radius: 6px;
      position: fixed;
      padding: 25px;
    }
  }
</style>
