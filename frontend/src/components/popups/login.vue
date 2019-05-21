<template >
<div class="login">
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="your@email.com" v-model="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
        </div>
        <button type="submit" class="wwt-btn" @click.prevent="submit">Sign In</button>
        <small >dont have an account? <b class="register" @click="open('register')">register</b></small>
    </form>
</div>
</template>

<script >
import axios from 'axios';
import popupContent from '../../mixins/popupContent';
import openPopup from '../../mixins/openPopup';

export default {
  name: 'login',
  mixins: [popupContent, openPopup],
  props: [],
  mounted() {
  },
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    async submit() {
      const form = {
        email: this.email,
        password: this.password,
      };
      try {
        await this.apiService.clearAuth();
        const response = await this.apiService.api('post', '/login', form);
        await this.apiService.setAuth(response.data);
        this.events.$emit('userUpdated', response.data.user.id);
        this.onSuccess(response.data);
      } catch (error) {
        this.onFailure(error);
      }
    },
  },
  computed: {

  },
};
</script>
<style scoped lang="scss">
  .login {
      .register {
          cursor: pointer;
      }
  }
</style>
