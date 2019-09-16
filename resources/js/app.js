/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('user-formulario-component', require('./components/UserFormularioComponent.vue').default);
Vue.component('proveedor-component', require('./components/ProveedorComponent.vue').default);
Vue.component('proveedor-formulario-component', require('./components/ProveedorFormularioComponent.vue').default);
Vue.component('remito-cabecera-component', require('./components/RemitoCabeceraComponent.vue').default);
Vue.component('remito-cabecera-formulario-component', require('./components/RemitoCabeceraFormularioComponent.vue').default);
Vue.component('remito-detalle-component', require('./components/RemitoDetalleComponent.vue').default);
Vue.component('remito-detalle-formulario-component', require('./components/RemitoDetalleFormularioComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
