<template lang="html">

  <section class="detail">
    <b><i :class="icons[keyName] || fallback"></i></b><span>{{' '}}</span>{{value}}
  </section>

</template>

<script lang="js">
  export default  {
    name: 'detail',
    props: {
      keyName: {
        type: String,
        required: true,
      },
      value: {
        type: [String, Number],
        required: true,
      },
    },
    mounted() {

    },
    data() {
      return {
        icons: {
          views: 'fas fa-eye',
          downloads: 'fas fa-download',
          school: 'fas fa-school',
          subject: 'fas fa-graduation-cap',
          rating: 'fas fa-star',
        },
        fallback: 'fas fa-exclamation',
      }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .detail {
    font-size: 2rem;
  }
</style>
