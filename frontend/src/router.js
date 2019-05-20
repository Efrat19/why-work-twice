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
      props: getIntId,
    },
    {
      path: '/homework/:id',
      component: homework,
      props: getIntId,
    },
    {
      path: '/admin',
      component: admin,
    },
  ],
});


function getIntId(route) {
  return {
    id: Number(route.params.id),
  };
}
