import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import VueCsrf from 'vue-csrf';

Vue.use(VueCsrf);
Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
