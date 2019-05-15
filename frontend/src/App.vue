<template>
  <div id="app">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
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

<style lang="scss">
  #app{
    font-family: 'Fira Sans', sans-serif;
    .wwt-btn{
      font-size: 1.6rem;
      padding: 10px;
      border: 1px solid black;
      border-radius: 6px;
      background-color: #fff64e;
      color: black;
      cursor: pointer;
      &:hover{
        color: #fff64e;
        background-color: black;
      }
    }
    .wwt-link{
      font-size: 1.6rem;
      color: black;
      cursor: pointer;
      text-decoration: none;
      &:hover{
        text-shadow: black;
      }
    }
    .wwt-status{
      font-size: 13rem;
      font-weight: bold;
      margin: 25% auto;
      text-align: center;
    }
  }
</style>