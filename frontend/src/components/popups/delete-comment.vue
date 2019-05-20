<template >

    <section class="delete-comment">
        <h3>delete comment {{payload.id}}</h3>
        <h2>sure about that?</h2>
        <button class="wwt-btn no" @click.prevent="close()">No, Cancel</button>
        <button class="wwt-btn yes" @click.prevent="submit()">Yeah</button>
    </section>

</template>

<script >
import popupContent from '../../mixins/popupContent';

export default {
  mixins: [popupContent],
  name: 'delete-comment',
  props: [],
  mounted() {

  },
  data() {
    return {};
  },
  methods: {
    async submit() {
      try {
        const response = await this.apiService.api('delete', `/comment/${this.payload.id}`);
        this.events.$emit('commentUpdated');
        this.onSuccess(response.data);
      } catch (error) {
        this.onFailure(error);
      }
    },
  },
  computed: {},
};
</script>

<style scoped lang="scss">
    .delete-comment {
        .no {
            float: left;
        }

        .yes {
            float: right;
        }
    }
</style>
