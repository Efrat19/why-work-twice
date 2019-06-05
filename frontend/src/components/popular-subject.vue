<template lang="html">

  <section class="popular-subject">
    <div class="grid">
      <h3 class="subject">{{subject}}</h3>
      <detail class="homework" keyName="homework" :value="homeworksNum" size="small"></detail>
      <detail class="user" keyName="user" :value="usersNum" size="small"></detail>
    </div>
  </section>

</template>

<script lang="js">

  import detail from './detail.vue';
  export default {
    name: 'popular-subject',
    props: {
      subject: {
        required: true,
        type: String,
      },
      homeworksNum: {
        required: true,
        type: Number,
      },
      usersNum: {
        required: true,
        type: Number,
      },
    },
    mounted() {

    },
    components: {
      detail,
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
  @import "../assets/scss_mixins";
  .popular-subject {
    @include shadow();
    background-color: white;
    border-radius: 6px;
    padding: 10px;
    margin: 10px auto;
    width: 30%;
    min-height: 150px;
    .grid{
      display: grid;
      grid-template-areas:
              "subject subject"
              "homework user";
      grid-template-columns: auto;
      grid-template-rows: 60% auto;
      .homework{
        grid-area: description;
      }
      .subject{
        grid-area: subject;
      }
      .user{
        grid-area: user;
      }
    }
  }
</style>
