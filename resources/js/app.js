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
Vue.component('errores', require('./components/Errores.vue').default);

Vue.component('user', require('./components/User.vue').default);
Vue.component('user-formulario', require('./components/UserFormulario.vue').default);
Vue.component('proveedor', require('./components/Proveedor.vue').default);
Vue.component('proveedor-formulario', require('./components/ProveedorFormulario.vue').default);
Vue.component('remito-cabecera', require('./components/RemitoCabecera.vue').default);
Vue.component('remito-cabecera-formulario', require('./components/RemitoCabeceraFormulario.vue').default);
Vue.component('remito-detalle', require('./components/RemitoDetalle.vue').default);
Vue.component('remito-detalle-formulario', require('./components/RemitoDetalleFormulario.vue').default);

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
