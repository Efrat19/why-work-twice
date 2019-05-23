<template >

  <section :class="['detail', size]">
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
    size: {
      type: String,
      default: 'large',
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
    &.large {
      font-size: 2rem;
      .icon {
        font-size: 3rem;
      }
    }
    &.small {
      font-size: 0.8rem;
      .icon {
        font-size: 1.5rem;
      }
    }
  }
</style>
