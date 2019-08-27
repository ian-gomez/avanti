<template>
    <div>
        <div>
            <label>{{articuloRegistro.nombre}}</label>
            <button class="btn btn-danger cierre">X</button>
        </div>
        <div>
            <label>Datos</label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['articuloRegistro'],

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>