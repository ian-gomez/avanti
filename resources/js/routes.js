import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Articulos from './components/Articulo.vue'
import Clientes from './components/Cliente.vue'
import Insumos from './components/Insumo.vue'
import VentasCabecera from './components/Venta_Cabecera'

Vue.component('indice', require('./components/Indice.vue').default);

Vue.component('errores', require('./components/Errores.vue').default);

Vue.component('articulo-formulario', require('./components/ArticuloFormulario.vue').default);
Vue.component('articulo-eliminado', require('./components/Articulo_Eliminado.vue').default);
Vue.component('articulo-insumo', require('./components/Articulo_Insumo.vue').default);
Vue.component('articulo-insumo-formulario', require('./components/Articulo_InsumoFormulario.vue').default);
Vue.component('cliente-formulario', require('./components/ClienteFormulario.vue').default);
Vue.component('insumo-formulario', require('./components/InsumoFormulario.vue').default);
Vue.component('venta-cabecera-formulario', require('./components/Venta_CabeceraFormulario.vue').default);
Vue.component('venta-detalle', require('./components/Venta_Detalle.vue').default);
Vue.component('venta-detalle-formulario', require('./components/Venta_DetalleFormulario.vue').default);

export default new VueRouter({
    routes: [
        {path: '/articulos', component: Articulos},
        {path: '/clientes', component: Clientes},
        {path: '/insumos', component: Insumos},
        {path: '/ventas-cabecera', component: VentasCabecera, alias: '/ventas'}
    ],
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    },
});