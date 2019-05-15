<template lang="html">

  <section class="hw-card">
    <div class="grid">
      <div class="image" @click="open('source')">
        <img :src="profile.path" alt="profile.path">
      </div>
      <detail class="rating" keyName="rating" :value="profile.rating"></detail>
      <detail class="views" keyName="views" :value="profile.views"></detail>
      <detail class="downloads" keyName="downloads" :value="profile.downloads"></detail>
      <detail class="school" keyName="school" :value="profile.school"></detail>
      <detail class="subject" keyName="subject" :value="profile.subject"></detail>
      <div class="user">
        <router-link :to="`/user/${profile.user_id}`">View All {{profile.user[0].name}} homeworks</router-link>
      </div>

    </div>
  </section>

</template>

<script lang="js">
  import openPopup from '../mixins/openPopup';
  import detail from './detail.vue';
  export default  {
    name: 'hw-card',
    mixins: [openPopup],
    components: {
      detail,
    },
    props: {
      profile: {
        type: Object,
        required: true,
      },
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
  .hw-card {
    .grid {
      display: grid;
      margin: 5%;
      grid-template-columns: 100px auto;
      grid-template-rows: auto;
      grid-gap: 7%;
      grid-template-areas:
              "image rating rating"
              "image views school"
              "image downloads subject "
              "image user user";

      .image {
        grid-area: image;
      }

      .rating {
        grid-area: rating;
      }

      .love {
        grid-area: love;
        cursor: pointer;
      }

      .views {
        grid-area: views;
      }

      .downloads {
        grid-area: downloads;
      }

      .school {
        grid-area: school;
      }

      .subject {
        grid-area: subject;
      }

      .user {
        grid-area: user;
      }

    }
  }
</style>