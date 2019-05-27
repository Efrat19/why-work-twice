<template lang="html">

  <section class="smart-search">
    <search-filter v-for="filter in filters" :key="filter.label" :label="filter.label" :options="filter.options"
            @addFilter="addFilter" @addResetCallback="addResetCallback"></search-filter>
    <button class="wwt-btn" @click="smartSearchGo">Go</button>
    <button class="wwt-btn" @click="reset">start over</button>
  </section>

</template>

<script lang="js">
import searchFilter from './filter.vue';

export default {
  name: 'smart-search',
  props: {
    filters: {
      type: Array,
      default: () => [],
    },
  },
  components: {
    searchFilter,
  },
  mounted() {
  },
  data() {
    return {
      selectedFilters: {},
      resetCallbacks: [],
    };
  },
  methods: {
    addFilter(filter) {
      this.selectedFilters = { ...filter, ...this.selectedFilters };
    },
    addResetCallback(callback) {
      this.resetCallbacks.push(callback);
    },
    reset() {
      this.resetCallbacks.map(callback => callback());
    },
    smartSearchGo() {
      this.$emit('smartSearchGo', this.selectedFilters);
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .smart-search {

  }
</style>
