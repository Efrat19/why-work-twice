<template >

  <section class="user-card">
    <div class="grid">
      <div class="image">
        <img :src="profile.image" alt="profile.image">
      </div>
      <detail class="uploads" keyName="document" :value="profile.uploads"></detail>
      <detail class="school" keyName="school" :value="profile.school.name"></detail>
      <detail class="subject" keyName="subject" :value="profile.subject.name"></detail>
      <detail v-if="profile.canEdit" class="edit" keyName="edit" value="edit"
              @click.native="open('edit-profile',{editMode: true, id: profile.id})"></detail>
    </div>
  </section>

</template>

<script >
import openPopup from '../mixins/openPopup';
import detail from './detail.vue';

export default {
  name: 'user-card',
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

    };
  },
  methods: {

  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  @import "../assets/scss_mixins";
  .user-card {
    .grid {
      @include shadow();
      height: 100%;
      display: grid;
      background-color: white;
      border-radius: 6px;
      grid-template-columns: 25% 25% 25% 25%;
      grid-template-rows: auto;
      grid-template-areas:
              "image uploads school edit"
              "image rating subject edit";
      .image {
        grid-area: image;
        margin: 20%;
        background-color: black;
      }

      .uploads {
        grid-area: uploads;
        margin: auto auto;
      }

      .edit {
        grid-area: edit;
        cursor: pointer;
        margin: auto auto;
      }

      .school {
        margin: auto auto;
        grid-area: school;
      }
      .rating {
        margin: auto auto;
        grid-area: rating;
      }

      .subject {
        margin: auto auto;
        grid-area: subject;
      }

    }
  }
</style>
