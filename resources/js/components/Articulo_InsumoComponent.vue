<template>
    <div class="contenedor2">
        <div class="titulo2">
            <label>{{articuloRegistro.nombre}}</label>
            <button class="btn btn-danger cierre" @click="$emit('cerrar-insumos')">X</button>
        </div>
        <div class="datos2">
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

<style>
    .contenedor2 {
            display: grid;
            grid-template-columns: 1fr 10fr 1fr;
            grid-template-rows: 1fr 1fr 9fr 1fr;
            grid-template-areas: 
            " . . ."
            " . titulo2 ."
            " . datos2 ."
            " . . .";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
    }
    .titulo2 {
        background-color: burlywood;
        grid-area: titulo2;
    }
    .datos2 {
        background-color: lemonchiffon;
        grid-area: datos2;
    }
	.cierre {
		float: right;
	}
</style>