<template >

  <section class="add-homework">
    <form>
      <h4>{{editMode ? 'Edit ': 'Add '}} Homework</h4>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" placeholder="my homework" v-model="description">
      </div>
      <div class="form-group">
        <label for="school">School</label>
        <input type="text" class="form-control" id="school" placeholder="my school" v-model="school">
      </div>
      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" placeholder="my subject" v-model="subject">
      </div>
      <div class="form-group">
        <label for="source">Source</label>
        <div class="wwt-btn">
          <detail :key-name="source? 'uploaded' : 'upload'" value="upload homework"></detail>
          <input type="file" class="inner-upload" id="source" name="myFile" @change="setSource($event)">
        </div>
      </div>
      <button type="submit"  class="wwt-btn"  @click.prevent="submit">Add Homework</button>
    </form>
  </section>

</template>

<script >
import popupContent from '../../mixins/popupContent';
import detail from '../detail';

export default {
  name: 'add-homework',
  mixins: [popupContent],
  props: [],
  mounted() {
    this.attemptInitFromUser();
  },
  components: {
    detail,
  },
  data() {
    return {
      source: '',
      description: '',
      school: '',
      subject: '',
    };
  },
  methods: {
    async submit() {
      const form = {
        source: this.source,
        description: this.description,
        school: this.school,
        subject: this.subject,
      };
      const uri = this.editMode ? `/homework/${this.payload.id}` : '/homework';
      const method = this.editMode ? 'put' : 'post';
      try {
        const response = await this.apiService.api(method, uri, form);
        this.events.$emit('homeworkUpdated', response.data.id);
        this.onSuccess(response.data);
      } catch (error) {
        this.onFailure(error);
      }
    },
    async getOld() {
      try {
        const old = await this.apiService.api('get', `/homework/${this.payload.id}`);
        this.source = old.data.source;
        this.description = old.data.description;
        this.school = old.data.school;
        this.subject = old.data.subject;
      } catch (error) {
        this.onFailure(error);
      }
    },
    setSource($event) {
      this.source = $event.target.value;
    },
    attemptInitFromUser() {
      this.school = (this.apiService.user && this.apiService.user.school && this.apiService.user.school.name) || '';
      this.subject = (this.apiService.user && this.apiService.user.subject && this.apiService.user.subject.name) || '';
    },
  },
};
</script>

<style scoped lang="scss">
  .add-homework {
    .wwt-btn {
      /*&#file-upload {*/
        /*padding: 0;*/
      /*}*/
      position: relative;
      .inner-upload {
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
      }
    }
  }
</style>
