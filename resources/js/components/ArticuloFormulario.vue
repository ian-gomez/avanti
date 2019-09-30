<template>
    <div class="contenedors">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="$emit('cerrar-formulario')">X</button>
        </div>
        <!-- En caso de alta -->
        <div class="datos" v-if="formulario==1">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="articuloRegistro.nombre">
            <br>
            <label>Tipo:</label>
            <br>
            <select class="form-control" v-model="opcionTipo">
                <option v-for="tipo in tipos" v-bind:value="tipo.id" v-bind:selected="(tipo.id == opcionTipo)">
                    {{tipo.nombre}}
                </option>
            </select>
            <label>Precio</label>
            <input class="form-control" step="0.01" type="number" v-model="articuloRegistro.precio">
            <br>
            <label>Costo:</label>
            <input class="form-control" step="0.01" type="number" v-model="articuloRegistro.costo">
        </div>
        <!-- En caso de modificacion -->
        <div class="datos" v-else-if="formulario==2">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="articuloRegistro.nombre">
            <br>
            <label>Tipo:</label>
            <select class="form-control" v-model="articuloRegistro.tipo_id">
                <option v-for="tipo in tipos" v-bind:value="tipo.id" v-bind:selected="(tipo.id == articuloRegistro.tipo_id)">
                    {{tipo.nombre}}
                </option>
            </select>
            <br>
            <label>Precio</label>
            <input class="form-control" step="0.01" type="number" v-model="articuloRegistro.precio">
            <br>
            <label>Costo:</label>
            <input class="form-control" step="0.01" type="number" v-model="articuloRegistro.costo">
        </div>
        <!-- En caso de baja -->
        <div class="datos" v-else>
            ¿Está seguro que desea eliminar {{articuloRegistro.nombre}}?
        </div>
        <div class="aceptar">
            <button class="bnt btn-success btn-block" @click="operacion()">Aceptar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['articuloRegistro', 'formulario'],
        data: function() {
            return{
                titulo:'',
                opcionTipo:1,
                tipos:[]
            }
        },
        mounted() {
            this.cargarTipos();
            if (this.formulario==1) {
                this.titulo='Ingresar nuevo articulo'
            };
            if (this.formulario==2) {
                this.titulo='Editar articulo'
            };
            if (this.formulario==3) {
                this.titulo='Eliminar articulo'
            };
        },
        methods: {
            cargarTipos:function() {
                axios.get('tipos').then(response=>{
                    this.tipos = response.data
                })
            },
            operacion:function(){
                if (this.formulario==1) {
                    this.alta()
                };
                if (this.formulario==2) {
                    this.modificar()
                };
                if (this.formulario==3) {
                    this.eliminar()
                };
            },
            alta:function(){
                const params = {
                    nombre: this.articuloRegistro.nombre,
                    tipo_id: this.opcionTipo,
                    precio: this.articuloRegistro.precio,
                    costo: this.articuloRegistro.costo,
                };
                axios.post('articulos', params).then(response => {
                    this.$emit('alta', response.data);
                })
            },
            modificar:function(){
                const params = {
                    nombre: this.articuloRegistro.nombre,
                    tipo_id: this.articuloRegistro.tipo_id,
                    precio: this.articuloRegistro.precio,
                    costo: this.articuloRegistro.costo,
                };
                axios.put('articulos/'+this.articuloRegistro.id, params).then(response => {
                    this.$emit('modificar');
                })
            },
            eliminar:function() {
                axios.delete('articulos/'+this.articuloRegistro.id).then(response =>{
                    this.$emit('eliminar');
                });
            }
        }
    }
</script>

<style>
	.contenedors {
        display: grid;
        grid-template-columns: 1fr 3fr 1fr;
        grid-template-rows: 1fr 1fr 3fr 1fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo ."
        " . datos ."
        " . aceptar ."
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
	.aceptar {
		text-align: center;
        grid-area: aceptar;
	}
</style>