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
            <input class="form-control" step="0.01" type="number" v-model="insumoRegistro.precio">
            <br>
            <label>Cantidad:</label>
            <input class="form-control" step="0.01" type="number" v-model="insumoRegistro.cantidad">
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
                let formdata = new FormData();
                formdata.append("nombre", this.insumoRegistro.nombre);
                formdata.append("precio", this.insumoRegistro.precio);
                formdata.append("cantidad", this.insumoRegistro.cantidad);
                axios.post('insumos', formdata).then(response => {
                    this.$emit('alta', response.data);
                })
            },
            modificar:function(){
                let formdata = new FormData();
                formdata.append("nombre", this.insumoRegistro.nombre);
                formdata.append("precio", this.insumoRegistro.precio);
                formdata.append("cantidad", this.insumoRegistro.cantidad);
                formdata.append("_method", "PATCH");
                axios.post('insumos/'+this.insumoRegistro.id, formdata).then(response => {
                    this.$emit('modificar');
                })
            },
            eliminar:function() {
                axios.post('insumos/'+this.insumoRegistro.id, {_method: 'delete'});
                this.$emit('eliminar');
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