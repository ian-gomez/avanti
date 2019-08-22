<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{articuloRegistro.nombre}}</label>
            <button class="btn btn-danger cierre" @click="$emit('cerrar-insumos')">X</button>
        </div>
        <div class="datos">
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
    .contenedor {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr;
            grid-template-rows: 1fr 1fr 3fr 1fr;
            grid-template-areas: 
            " . . ."
            " . titulo ."
            " . datos ."
            " . . .";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
    }
    .titulo {
        background-color: burlywood;
        grid-area: titulo;
    }
    .datos {
        background-color: lemonchiffon;
        grid-area: datos;
    }
	.cierre {
		float: right;
	}
</style>