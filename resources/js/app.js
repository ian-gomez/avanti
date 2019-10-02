require('./bootstrap');

window.Vue = require('vue');
window.Axios = require('axios').default;

Vue.use(require('vue-moment'));

import router from './routes.js'

const app = new Vue({
    el: '#app',
    router
});
