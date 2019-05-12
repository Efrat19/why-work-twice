<template lang="html">
  <section class="register">
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
  import popupContent from '../../mixins/popupContent';
  export default {
    name: 'register',
    mixins: [popupContent],
    props: [],
    data() {
      return {
        name: `efrat${Math.random().toString(36).substr(2, 5)}`,
        email: `efrat@yad2.co.il${Math.random().toString(36).substr(2, 5)}`,
        subject: 'sdfhgd',
        school: 'thszdf',
        password: '11111111',
        confirmPassword: '11111111',
        success: false,
      };
    },
    methods: {
      async submit(){
        const form = {
          name: this.name,
          email: this.email,
          subject: this.subject,
          school: this.school,
          password: this.password,
          password_confirmation: this.confirmPassword,
        };
        const response = await this.apiService.signUp(form);
        this.onSuccess(response);
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
  .register {

  }
</style>
