<template>
    <div class="container">
        <router-link to="/articulos" class="btn btn-outline-primary">Articulos</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
