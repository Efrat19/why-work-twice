<template lang="html">

  <section class="hw-card">
    <div class="grid">
      <div class="image" @click="open('source')">
        <img :src="profile.path" alt="profile.path">
      </div>
      <detail class="rating" keyName="rating" :value="profile.rating"></detail>
      <router-link class="user wwt-link" :to="`/user/${profile.user_id}`">
        <detail keyName="user" :value="profile.user.name"></detail>
      </router-link>
      <detail class="views" keyName="views" :value="profile.views"></detail>
      <detail class="downloads" keyName="downloads" :value="profile.downloads"></detail>
      <detail class="school" keyName="school" :value="profile.school.name"></detail>
      <detail class="subject" keyName="subject" :value="profile.subject.name"></detail>
      <detail v-if="profile.canEdit" class="edit" keyName="edit" value="edit"
              @click.native="open('add-homework',{editMode: true, id: profile.id})"></detail>
      <detail v-if="profile.canDelete" class="delete" keyName="delete" value="delete"
              @click.native="open('delete-homework',{id: profile.id})"></detail>
      <div class="love" @click="toggleLove(!profile.loved)">
        profile.loved {{profile.loved}}
        <i :class="profile.loved ? 'fas fa-heart': 'far fa-heart'"></i>
      </div>
      <div class="user-link">

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
  @import "../assets/scss_mixins";
  .hw-card {
    .grid {
      height: 100%;
      display: grid;
      background-color: white;
      border-radius: 6px;
      @include shadow();
      grid-template-columns: 25% 25% 25% 25%;
      grid-template-rows: 33% 33% 33%;
      /*grid-gap: 7%;*/
      grid-template-areas:
              "image rating user love"
              "image views school edit"
              "image downloads subject delete";
      .image {
        grid-area: image;
        margin: 20%;
        background-color: black;
      }

      .rating {
        grid-area: rating;
        margin: auto auto;
      }

      .user {
        grid-area: user;
        margin: auto auto;
      }

      .love {
        grid-area: love;
        cursor: pointer;
        margin: auto auto;
      }

      .edit {
        grid-area: edit;
        cursor: pointer;
        margin: auto auto;
      }

      .delete {
        grid-area: delete;
        cursor: pointer;
        margin: auto auto;
      }

      .views {
        margin: auto auto;
        grid-area: views;
      }

      .downloads {
        margin: auto auto;
        grid-area: downloads;
      }

      .school {
        margin: auto auto;
        grid-area: school;
      }

      .subject {
        margin: auto auto;
        grid-area: subject;
      }

      .user-link {
        margin: auto auto;
        grid-area: user-link;
      }

    }
  }
</style>