<template lang="html">
  <div class="popup">
    <div class="page">
      <i class="fas fa-times" @click="close()"></i>
      <component :is="name" :payload="store.getters.getPayload" :popupName="name" @setErrors="setErrors"></component>
        <div class="errors" v-if="errors.length">
            <li class="error" v-for="error in errors">{{error}}</li>
        </div>
      </div>
    <div class="cover"  @click="close()"></div>
  </div>
</template>

<script lang="js">
  import login from './popups/login.vue';
  import register from './popups/register.vue';
  import logout from './popups/logout.vue';
  import addComment from './popups/add-comment.vue';
  import addHomework from './popups/add-homework.vue';
  import deleteComment from './popups/delete-comment.vue';
  import deleteHomework from './popups/delete-homework.vue';
  import editProfile from './popups/edit-profile.vue';
  import store from '../store';
  export default  {
    name: 'popup',
    props: {
       name: {
         type: String,
         required: true,
       }
    },
    components: {
        login,
        logout,
        register,
      addComment,
      addHomework,
      deleteComment,
      deleteHomework,
      editProfile,
    },
    mounted() {

    },
    data() {
      return {
        store,
        errors: [],
      }
    },
    methods: {
      close(){
        this.store.dispatch('close', this.name);
      },
      setErrors(errors){
        this.errors = errors;
      },
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .popup {
    position: relative;
    .cover{
      position: fixed;
      height:100vh;
      z-index: 20;
      background-color: black;
      width: 100%;
      opacity: 0.7;
      cursor: pointer;
    }
    .page{
      .fas {
        float: right;
        cursor: pointer;
      }
        .errors{
            .error{
                border: 1px solid darken(#fff64e,0%);
                border-radius: 6px;
              padding: 5px;
                background-color: lighten(#fff64e,20%);
                margin: 5px;
            }
        }
      z-index: 30;
      background-color: white;
      position: fixed;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      border-radius: 6px;
      padding: 25px;

    }
  }
</style>
