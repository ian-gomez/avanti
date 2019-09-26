<template>
    <div class="container">
        <div>
            <router-link to="/articulos" class="btn btn-outline-primary" @click="cambiarTitulo(0)">Articulos</router-link>
            <router-link to="/clientes" class="btn btn-outline-primary">Clientes</router-link>
            <router-link to="/insumos" class="btn btn-outline-primary">Insumos</router-link>
            <router-link to="/ventas-cabecera" class="btn btn-outline-primary">Ventas</router-link>
        </div>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
