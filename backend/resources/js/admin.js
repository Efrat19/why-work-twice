
import search from '../../../frontend/src/components/search.vue';
import renderVueComponentToString from 'vue-server-renderer/basic';

require('./bootstrap');

window.Vue = require('vue');


const app = new Vue({
    el: '#app',
    components: {
        search,
    }
});


renderVueComponentToString(app, (err, html) => {
    if (err) {
        throw new Error(err);
    }

    dispatch(html);
});
