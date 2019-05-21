<template >

  <section class="homework">
   <div class="grid">
     <div class="description">{{homework.description}} {{homework.id}}</div>
     <detail class="rating" keyName="rating" :value="homework.rating" size="small"></detail>
     <detail class="school" keyName="school" :value="homework.school.name" size="small"></detail>
     <detail class="subject" keyName="subject" :value="homework.subject.name" size="small"></detail>
     <div class="author">{{getAuthorDetails()}}</div>
   </div>
  </section>

</template>

<script >
import openPopup from '../mixins/openPopup';
import store from '../store';
import detail from './detail.vue';

export default {
  name: 'homework',
  mixins: [openPopup],
  components: {
    detail,
  },
  props: {
    homework: {
      type: Object,
      required: true,
    },
  },
  mounted() {

  },
  data() {
    return {
      store,
    };
  },
  methods: {
    getAuthorDetails() {
      const isUpdated = this.homework.created_at !== this.homework.updated_at;
      return `from ${this.homework.created_at}${isUpdated ? `, last updated at ${this.homework.updated_at}` : ''}`;
    },
  },
  computed: {
  },
};
</script>

<style scoped lang="scss">
  @import "../assets/scss_mixins";
  .homework {
    @include shadow();
    background-color: white;
    border-radius: 6px;
    padding: 10px;
    margin: 10px auto;
    width: 30%;
    min-height: 150px;
    .grid{
      display: grid;
      grid-gap: 5px;
      grid-template-areas:
              "description description description rating"
              "school school subject subject"
              "author author author author";
      grid-template-columns: auto;
      grid-template-rows: 33% 33% 33%;
      .description{
        grid-area: description;
        font-size: 1em;
      }
      .rating{
        grid-area: rating;
        font-size: 1.7rem;
        cursor: pointer;
      }
      .school{
        grid-area: school;
        font-size: 1.7rem;
        cursor: pointer;
      }
      .subject{
        grid-area: subject;
        font-size: 1.7rem;
      }
      .author{
        grid-area: author;
        font-size: 1.3rem;
      }
    }
  }
</style>
