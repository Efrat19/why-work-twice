<template>
  <div id="app">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
