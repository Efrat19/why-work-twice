<template >

  <section class="add-comment">
    <form>
      <h4>{{editMode ? 'Edit ': 'Add '}} Comment</h4>
      <div class="form-group">
        <label for="header1">Header</label>
        <input type="text" class="form-control" id="header1" aria-describedby="emailHelp" placeholder="wtf" v-model="header">
      </div>
      <div class="form-group">
        <label for="body1">Body</label>
        <textarea class="form-control" id="body1" v-model="body" placeholder="drop it all here..."></textarea>
      </div>
      <button type="submit"  class="wwt-btn"  @click.prevent="submit">Comment</button>
    </form>
  </section>

</template>

<script >
import popupContent from '../../mixins/popupContent';

export default {
  name: 'add-comment',
  mixins: [popupContent],
  props: [],
  mounted() {
  },
  data() {
    return {
      header: '',
      body: '',
    };
  },
  methods: {
    async submit() {
      const form = {
        id: this.payload.id,
        body: this.body,
        header: this.header,
        homeworkId: this.payload.homeworkId,
      };
      const uri = this.editMode ? `/comment/${this.payload.id}` : '/comment';
      const method = this.editMode ? 'put' : 'post';
      try {
        const response = await this.apiService.api(method, uri, form);
        this.events.$emit('commentUpdated');
        this.onSuccess(response.data);
      } catch (error) {
        this.onFailure(error);
      }
    },
    async getOld() {
      try {
        const old = await this.apiService.api('get', `/comment/${this.payload.id}`);
        this.header = old.data.header;
        this.body = old.data.body;
      } catch (error) {
        this.onFailure(error);
      }
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .add-comment {

  }
</style>
