<template lang="html">

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
        <input type="file" class="form-control" id="source" name="myFile" @change="setSource($event)">
      </div>
      <button type="submit"  class="wwt-btn"  @click.prevent="submit">Add Homework</button>
    </form>
  </section>

</template>

<script lang="js">
  import popupContent from '../../mixins/popupContent';
  export default {
    name: 'add-homework',
    mixins: [popupContent],
    props: [],
    mounted() {
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
      setSource($event){
        this.source = $event.target.value;
      }
    }
  }
</script>

<style scoped lang="scss">
  .add-homework {

  }
</style>
