<template >

  <section class="detail">
    <b><i class="icon" :class="icons[keyName] || fallback"></i></b><span>{{' '}}</span>{{value}}
  </section>

</template>

<script >
export default {
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
        comment: 'fas fa-comments',
        user: 'fas fa-user',
        edit: 'fas fa-edit',
        delete: 'fas fa-trash-alt',
        upload: 'fas fa-upload',
        uploaded: 'fas fa-check',
        document: 'fas fa-file-upload',
      },
      fallback: 'fas fa-exclamation',
    };
  },
  methods: {

  },
  computed: {

  },
};
</script>

<style scoped lang="scss">
  .detail {
    font-size: 2rem;
    .icon {
      font-size: 4rem;
    }
  }
</style>
