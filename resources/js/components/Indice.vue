<template>
    <div class="container">
        <router-link v-bind:to="{name:'articulos'}">Articulos</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounteddddddddddddddd.')
        }
    }
</script>
