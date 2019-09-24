import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

export default new Router({
    routes: [
        {
            name: 'articulos',
            path: '/articulos',
            component:require('./components/Articulo.vue'),
        },
    ],
    mode:'history'
});