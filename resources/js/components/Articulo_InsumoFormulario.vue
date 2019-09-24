<template>
    <div class="contenedor-formulario">
        <div class="titulo-formulario">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="$emit('cerrar-formulario')">X</button>
        </div>
        <!-- En caso de alta -->
        <div class="datos-formulario" v-if="formulario==1">
            <label>Insumo:</label>
            <br>
            <select class="form-control" v-model="opcionInsumo">
                <option v-for="insumo in insumos" v-bind:value="insumo.id" v-bind:selected="(insumo.id == opcionInsumo)">
                    {{insumo.nombre}}
                </option>
            </select>
            <label>Cantidad</label>
            <input class="form-control" step="0.01" type="number" v-model="articuloInsumoRegistro.cantidad">
        </div>
        <!-- En caso de modificacion -->
        <div class="datos-formulario" v-else-if="formulario==2">
            <label>Cantidad</label>
            <input class="form-control" step="0.01" type="number" v-model="articuloInsumoRegistro.cantidad">
        </div>
        <!-- En caso de baja -->
        <div class="datos-formulario" v-else>
            <label>¿Está seguro que desea eliminar este campo?</label>
        </div>
        <div class="aceptar-formulario">
            <button class="bnt btn-success btn-block" @click="operacion()">Aceptar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['articuloInsumoRegistro', 'articulo_id', 'formulario'],
        data: function() {
            return{
                titulo:'',
                opcionInsumo:1,
                insumos:[]
            }
        },
        mounted() {
            this.cargarInsumos();
            if (this.formulario==1) {
                this.titulo='Agregar nuevo insumo'
            };
            if (this.formulario==2) {
                this.titulo='Editar insumo'
            };
            if (this.formulario==3) {
                this.titulo='Eliminar insumo'
            };
        },
        methods: {
            cargarInsumos:function() {
                axios.get('insumos-datos').then(response=>{
                    this.insumos = response.data
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
                    articulo_id: this.articulo_id,
                    insumo_id: this.opcionInsumo,
                    cantidad: this.articuloInsumoRegistro.cantidad,
                };
                axios.post('articulos-insumos', params).then(response => {
                    this.$emit('alta', response.data);
                })
            },
            modificar:function(){
                const params = {
                    articulo_id: this.articuloInsumoRegistro.articulo_id,
                    insumo_id: this.articuloInsumoRegistro.insumo_id,
                    cantidad: this.articuloInsumoRegistro.cantidad,
                };
                axios.put('articulos-insumos/'+this.articuloInsumoRegistro.id, params).then(response => {
                    this.$emit('modificar');
                })
            },
            eliminar:function() {
                axios.delete('articulos-insumos/'+this.articuloInsumoRegistro.id).then(response => {
                    this.$emit('eliminar');
                });
            }
        }
    }
</script>

<style>
	.contenedor-formulario {
        display: grid;
        grid-template-columns: 1fr 3fr 1fr;
        grid-template-rows: 1fr 1fr 3fr 1fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo-formulario ."
        " . datos-formulario ."
        " . aceptar-formulario ."
        " . . .";
        position: fixed;
		top: 0;
		left: 0;
        width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.5);
	}
	.titulo-formulario {
		background-color: burlywood;
        grid-area: titulo-formulario;
	}
	.datos-formulario {
		background-color: lemonchiffon;
        grid-area: datos-formulario;
	}
	.cierre {
		float: right;
	}
	.aceptar-formulario {
		text-align: center;
        grid-area: aceptar-formulario;
	}
</style>