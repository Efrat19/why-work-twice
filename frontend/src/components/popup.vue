<template lang="html">
  <div class="popup">
    <div class="page">
      <i class="fas fa-times" @click="close()"></i>
      <component :is="name" :payload="store.getters.getPayload" :popupName="name"></component>
       <div v-if="response">
          <div v-if="success">
            {{response}}
          </div>
           <div v-if="failure">
            {{response}}
            
          </div>
        </div>
      </div>
    <div class="cover"></div>
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
    },
    mounted() {

    },
    data() {
      return {
        store,
      }
    },
    methods: {
      close(){
        this.store.dispatch('close', this.name);
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
      position: absolute;
      z-index: 20;
      background-color: black;
      width: 100%;
      height: 1000px;
      opacity: 0.7;
    }
    .page{
      .fas {
        float: right;
        cursor: pointer;
      }
      z-index: 30;
      background-color: white;
      top: 30%;
      left: 30%;
      border-radius: 6px;
      position: fixed;
      padding: 25px;
    }
  }
</style>
