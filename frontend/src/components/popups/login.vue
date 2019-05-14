<template lang="html">
<div class="login">
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
    name: 'login',
      mixins: [popupContent],
    props: [],
    mounted() {
    },
    data() {
      return {
          email: '',
          password: '',
      }
    },
    methods: {
        async submit(){
            const form = {
                email: this.email,
                password: this.password,
            };
            try {
                await this.apiService.clearAuth();
                const response = await this.apiService.api('post', '/login', form);
                await this.apiService.setAuth(response.data);
                this.onSuccess(response.data);
            }
            catch (error) {
                this.onFailure(error);
            }
        },
    },
    computed: {

    }
}
</script>
<style scoped lang="scss">
  .login {

  }
</style>
