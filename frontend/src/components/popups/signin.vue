<template lang="html">
<div class="signin">
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="your@email.com" v-model="email">
            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="submit">Sign In</button>
    </form>
</div>
</template>

<script lang="js">
    import popupContent from '../../mixins/popupContent'
  import axios from 'axios';
  export default {
    name: 'signin',
      mixins: [popupContent],
    props: [],
    mounted() {
    },
    data() {
      return {
          email: '',
          password: '',
          success: false,
      }
    },
    methods: {
      submit(){
          const data = {
              email: this.email,
              password: this.password,
          };
        axios.post(`${process.env.VUE_APP_ROOT_API}/login`, data).then(this.onSuccess);
      },
        onSuccess(){
          this.success = true;
            window.setTimeout(this.close, 1);
        },
    },
    computed: {

    }
}
</script>

<style scoped lang="scss">
  .signin {

  }
</style>
