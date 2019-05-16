import Vue from 'vue';
import Router from 'vue-router';
import home from './components/home.vue';
import user from './components/user.vue';
import homework from './components/homework.vue';
import admin from './components/admin.vue';

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
      path: '/user/:id',
      component: user,
    },
    {
      path: '/homework/:id',
      component: homework,
    },
    {
      path: '/admin',
      component: admin,
    },
  ],
});
