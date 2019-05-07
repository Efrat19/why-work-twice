<template>
  <div id="app">
    <site></site>
  </div>
</template>

<script>
  import site from './components/site.vue'
  export default {
    name: 'app',
    data () {
      return {
      }
    },
    components:{
      site,
    }
  }
</script>
