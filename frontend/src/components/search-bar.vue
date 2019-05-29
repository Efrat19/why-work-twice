<template >
    <section class="search-bar">
      <input type="text" class="wwt-input bar form-control" v-model="bar"
             @input="searchInput()" :placeholder="`search ${resultType}s...`">
    </section>
</template>

<script >
import _ from 'lodash';

export default {
  name: 'search',
  props: {
    resultType: {
      type: String,
      required: true,
    },
    url: {
      type: String,
      required: true,
    },
  },
  mounted() {

  },
  data() {
    return {
      bar: '',
    };
  },
  methods: {
    searchInput() {
      _.debounce(this.emitSearchInput, 1000)();
    },
    emitSearchInput() {
      this.$emit('searchInput', `${this.url}?q=${this.bar}`);
    },
  },
};
</script>

<style scoped lang="scss">
    .search-bar{
      margin: 5% auto;
  }
</style>
