import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {path: '/articulos', component:require('./components/Articulo.vue')}
]

export default new VueRouter({
    routes,
    mode:'history'
});