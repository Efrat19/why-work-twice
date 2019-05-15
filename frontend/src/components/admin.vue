<template lang="html">

  <section class="admin">
    <details>
      <summary>
        users
      </summary>
    </details>
    <details>
      <summary>
        homeworks
      </summary>
    </details>
    <details>
      <summary>
        comment
      </summary>
    </details>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script lang="js">
  export default  {
    name: 'admin',
    props: [],
    mounted() {
      this.authorize();
    },
    data() {
      return {
        authorated: false,
        error: 0,
      }
    },
    methods: {
      async authorize() {
        try{
          const response = await this.apiService.api('get', '/authorize');
          this.authorated = response.data;
          this.error = '';
        }
        catch (e) {
          this.onFailure(e);
        }
      },
      onFailure(error){
        this.error = error.response.status;
      }
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .admin {

  }
</style>
admin ep:


search users
search homeworks
search comments
create a user



