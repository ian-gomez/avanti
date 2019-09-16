/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-moment'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('articulo-component', require('./components/ArticuloComponent.vue').default);
Vue.component('articulo-formulario-component', require('./components/ArticuloFormularioComponent.vue').default);
Vue.component('articulo-insumo-component', require('./components/Articulo_InsumoComponent.vue').default);
Vue.component('articulo-insumo-formulario-component', require('./components/Articulo_InsumoFormularioComponent.vue').default);
Vue.component('cliente-component', require('./components/ClienteComponent.vue').default);
Vue.component('cliente-formulario-component', require('./components/ClienteFormularioComponent.vue').default);
Vue.component('insumo-component', require('./components/InsumoComponent.vue').default);
Vue.component('insumo-formulario-component', require('./components/InsumoFormularioComponent.vue').default);
Vue.component('venta-cabecera-component', require('./components/Venta_CabeceraComponent.vue').default);
Vue.component('venta-cabecera-formulario-component', require('./components/Venta_CabeceraFormularioComponent.vue').default);
Vue.component('venta-detalle-component', require('./components/Venta_DetalleComponent.vue').default);
Vue.component('venta-detalle-formulario-component', require('./components/Venta_DetalleFormularioComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
