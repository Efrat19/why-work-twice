<template lang="html">
  <div class="grid-container">
    <navbar></navbar>
    <router-view></router-view>
  </div>
</template>

<script lang="js">
  import navbar from './navbar.vue'
  export default  {
    name: 'site',
    props: [],
    components:{
      navbar,
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
  .site {

  }
</style>
