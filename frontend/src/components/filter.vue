<template lang="html">
  <section class="filter">
    <select :name="label" @change="onSelect" v-model="filterValue">
      <option value="-1" selected disabled hidden>select {{label}}</option>
      <option v-for="option in options" :key="option.value" :value="option.value">{{option.text}}</option>
    </select>
  </section>

</template>

<script lang="js">
export default {
  name: 'filter',
  props: {
    options: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      required: true,
    },
  },
  mounted() {

  },
  data() {
    return {
      filterValue: -1,
    };
  },
  methods: {
    onSelect() {
      const filter = {};
      filter[this.label] = this.filterValue;
      this.$emit('addFilter', filter);
      this.$emit('addResetCallback', this.reset);
    },
    reset() {
      this.filterValue = -1;
    },
  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .filter {

  }
</style>
