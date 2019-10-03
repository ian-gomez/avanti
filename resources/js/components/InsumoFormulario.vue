<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="$emit('cerrar-ventana')">X</button>
        </div>
        <!-- En caso de baja -->
        <div class="datos" v-if="formulario==3">
            ¿Está seguro que desea eliminar a {{insumoRegistro.nombre}}?
        </div>
        <!-- En caso de alta -->
        <div class="datos" v-else>
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="insumoRegistro.nombre">
            <br>
            <label>Precio:</label>
            <input class="form-control" step="0.01" min="0.01" max="9999" type="number" v-model="insumoRegistro.precio">
        </div>
        <div class="aceptar">
            <button class="bnt btn-success btn-block" @click="operacion()">Aceptar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['insumoRegistro', 'formulario'],
        data: function() {
            return{
                titulo:'',
            }
        },
        mounted() {
            if (this.formulario==1) {
                this.titulo='Ingresar nuevo insumo'
            };
            if (this.formulario==2) {
                this.titulo='Editar insumo'
            };
            if (this.formulario==3) {
                this.titulo='Eliminar insumo'
            };
        },
        methods: {
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
                    nombre: this.insumoRegistro.nombre,
                    precio: this.insumoRegistro.precio,
                };
                axios.post('insumos', params).then(response => {
                    this.$emit('alta', response.data);
                }).catch(function (error) {
                    alert("Los datos ingresados no son válidos.");
                });
            },
            modificar:function(){
                const params = {
                    nombre: this.insumoRegistro.nombre,
                    precio: this.insumoRegistro.precio,
                }
                axios.put('insumos/'+this.insumoRegistro.id, params).then(response => {
                    this.$emit('modificar');
                }).catch(function (error) {
                    alert("Los datos ingresados no son válidos.");
                });
            },
            eliminar:function() {
                axios.delete('insumos/'+this.insumoRegistro.id).then(response => {
                    this.$emit('eliminar');
                })
            }
        }
    }
</script>

<style>
	.contenedor {
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