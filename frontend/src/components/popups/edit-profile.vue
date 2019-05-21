<template >

  <section class="edit-profile">
    <label for="exampleInputName">Your Name:</label>
    <input type="text" class="form-control" id="exampleInputName" placeholder="Efrat" v-model="name">
    </div>
    <div class="form-group">
      <label for="exampleInputSchool">Where Do You Study?</label>
      <input type="text" class="form-control" id="exampleInputSchool" v-model="subject">
    </div>
    <div class="form-group">
      <label for="exampleInputSubject">What Exactly Are You Studying now?</label>
      <input type="text" class="form-control" id="exampleInputSubject"  v-model="school">
    </div>
    <button type="submit"  class="wwt-btn"  @click.prevent="submit">Save Changes</button>
  </section>

</template>

<script >
import popupContent from '../../mixins/popupContent';

export default {
  mixins: [popupContent],
  props: [],
  name: 'edit-profile',
  mounted() {

  },
  data() {
    return {
      name: '',
      subject: '',
      school: '',
    };
  },
  methods: {
    async submit() {
      const form = {
        id: this.payload.id,
        name: this.name,
        subject: this.subject,
        school: this.school,
      };
      try {
        const response = await this.apiService.api('put', `/user/${this.payload.id}`, form);
        await this.store.dispatch('setUser', response.data);
        await localStorage.setItem('user', JSON.stringify(response.data));
        this.events.$emit('userUpdated', response.data.id);
        this.onSuccess(response.data);
      } catch (error) {
        this.onFailure(error);
      }
    },
    async getOld() {
      const old = await this.apiService.api('get', `/user/${this.payload.id}`);
      this.name = old.data.name;
      this.subject = old.data.subject.name;
      this.school = old.data.school.name;
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .edit-profile {

  }
</style>
