<template lang="html">

  <section class="admin">
    <!--<details>-->

    <div class="page" v-if="page" v-html="page"></div>
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script lang="js">
  import apiService from '../services/apiService';
  import search from './search'
  export default  {
    name: 'admin',
    props: [],
    components: {
      search,
    },
    mounted() {
      this.getAdminPage();
    },
    data() {
      return {
        apiService,
        page: false,
        error: 0,
      }
    },
    methods: {
      async getAdminPage() {
        try{
          const response = await this.apiService.api('get', '/admin/');
          this.page = response.data;
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

