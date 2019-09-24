require('./bootstrap');

window.Vue = require('vue');
window.Axios = require('axios').default;

Vue.use(require('vue-moment'));

Vue.component('indice', require('./components/Indice.vue').default);

import router from './routes';
/*
Vue.component('articulo', require('./components/Articulo.vue').default);
Vue.component('articulo-formulario', require('./components/ArticuloFormulario.vue').default);
Vue.component('articulo-eliminado', require('./components/Articulo_Eliminado.vue').default);
Vue.component('articulo-insumo', require('./components/Articulo_Insumo.vue').default);
Vue.component('articulo-insumo-formulario', require('./components/Articulo_InsumoFormulario.vue').default);
Vue.component('cliente', require('./components/Cliente.vue').default);
Vue.component('cliente-formulario', require('./components/ClienteFormulario.vue').default);
Vue.component('insumo', require('./components/Insumo.vue').default);
Vue.component('insumo-formulario', require('./components/InsumoFormulario.vue').default);
Vue.component('venta-cabecera', require('./components/Venta_Cabecera.vue').default);
Vue.component('venta-cabecera-formulario', require('./components/Venta_CabeceraFormulario.vue').default);
Vue.component('venta-detalle', require('./components/Venta_Detalle.vue').default);
Vue.component('venta-detalle-formulario', require('./components/Venta_DetalleFormulario.vue').default);
*/

const appVue = new Vue({
    el: '#appVue',
    router
});
