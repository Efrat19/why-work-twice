<template lang="html">

  <section class="user">
    <h1>user Component</h1>
    <!--<div class="edit" v-if="profile.canEdit">-->
      <i class="fas fa-edit" @click="open('edit-profile',{editMode: true, id})"></i>
    <!--</div>-->
    <div class="wwt-status" v-if="error">
      {{error}}
    </div>
  </section>

</template>

<script lang="js">
  import openPopup from '../mixins/openPopup';
  import apiService from '../services/apiService'
  export default  {
    name: 'user',
    props: [],
    mixins: [openPopup],
    mounted() {
      this.id = parseInt(this.$route.params.id, 10);
      this.getProfile();
    },
    data() {
      return {
        apiService,
        id: false,
        profile: null,
        error: '',
      };
    },
    methods: {
      async getProfile() {
        try{
          const response = await this.apiService.api('get', `/user/${this.id}`);
          this.profile = response.data;
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
  .user {

  }
</style>
