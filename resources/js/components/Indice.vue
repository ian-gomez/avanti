<template>
    <div class="container">
        <div>
            <router-link to="/articulos" class="btn btn-outline-primary">Articulos</router-link>
            <router-link to="/clientes" class="btn btn-outline-primary">Clientes</router-link>
            <router-link to="/insumos" class="btn btn-outline-primary">Insumos</router-link>
            <router-link to="/ventas" class="btn btn-outline-primary">Ventas</router-link>
        </div>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
