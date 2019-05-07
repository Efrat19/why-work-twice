<template lang="html">
  <navbar></navbar>
  <router-view></router-view>
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
