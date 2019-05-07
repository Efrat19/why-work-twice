<template lang="html">
  <section class="signup">
    <form>
      <div class="form-group">
        <label for="exampleInputName">Whats Your Name?</label>
        <input type="text" class="form-control" id="exampleInputName" placeholder="Efrat" v-model="name">
      </div>
      <div>
        <label for="exampleInputEmail1">And Your Email?</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="your@email.com" v-model="email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputSchool">Where Do You Study?</label>
        <input type="text" class="form-control" id="exampleInputSchool" v-model="subject">
      </div>
      <div class="form-group">
        <label for="exampleInputSubject">What Exactly Are You Studying now?</label>
        <input type="text" class="form-control" id="exampleInputSubject"  v-model="school">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Hit Your Password...</label>
        <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword2">Again Please....</label>
        <input type="password" class="form-control" id="exampleInputPassword2" v-model="confirmPassword">
      </div>
      <button type="submit" class="btn btn-primary" @click.prevent="submit">Sign In</button>
    </form>
  </section>
</template>

<script lang="js">
  import popupContent from '../../mixins/popupContent'
  import axios from 'axios';
  export default {
    name: 'signup',
    mixins: [popupContent],
    props: [],
    mounted() {
      console.log(process.env.VUE_APP_ROOT_API);
      console.log(process.env);
    },
    data() {
      return {
        name: '',
        email: '',
        subject: '',
        school: '',
        password: '',
        confirmPassword: '',
        success: false,
      }
    },
    methods: {
      submit(){
        const data = {
          email: this.email,
          password: this.password,
        };
        axios.post(`${process.env.VUE_APP_ROOT_API}/register`, data).then(this.onSuccess);
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
  .signup {

  }
</style>
