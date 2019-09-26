require('./bootstrap');

window.Vue = require('vue');
window.Axios = require('axios').default;

Vue.use(require('vue-moment'));

Vue.component('indice', require('./components/Indice.vue').default);

import router from './routes.js'

const app = new Vue({
    el: '#app',
    router
});
