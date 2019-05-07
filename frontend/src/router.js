import Vue from 'vue';
import Router from 'vue-router';
import home from './components/home.vue'
import user from './components/user.vue'
import homework from './components/homework.vue'
Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: home,
    },
    {
      path: '/user',
      name: 'user',
      component: user,
    },
    {
      path: '/homework',
      name: 'homework',
      component: homework,
    },
  ],
});
