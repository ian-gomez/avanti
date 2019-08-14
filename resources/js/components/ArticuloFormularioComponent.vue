<template>
    <div class="contenedor">
        <div class="cuadro">
            <div class="titulo">
                <label>{{titulo}}</label>
                <button class="btn btn-danger cierre" @click="$emit('cerrar-ventana')">X</button>
            </div>
            <div class="datos">
                <label>Nombre:</label>
                <input required class="form-control" type="text" v-model="articuloRegistro.nombre">
                <br>
                <label>Tipo:</label>
                <input required class="form-control" type="text" v-model="articuloRegistro.tipo">
                <br>
                <label>Precio</label>
                <input required class="form-control" step="0.01" type="number" v-model="articuloRegistro.precio">
                <br>
                <label>Costo:</label>
                <input required class="form-control" step="0.01" type="number" v-model="articuloRegistro.costo">
            </div>
            <div class="aceptar">
                <button class="bnt btn-success btn-block" @click="operacion()">Aceptar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['articuloRegistro', 'formulario'],
        data: function() {
            return{
                titulo:''
            }
        },
        mounted() {
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
                formdata.append("nombre", this.articuloRegistro.nombre);
                formdata.append("tipo", this.articuloRegistro.tipo);
                formdata.append("precio", this.articuloRegistro.precio);
                formdata.append("costo", this.articuloRegistro.costo);
                axios.post('articulos', formdata).then(response => {
                    this.$emit('alta', response.data);
                })
            },
            modificar:function(){
                let formdata = new FormData();
                formdata.append("nombre", this.articuloRegistro.nombre);
                formdata.append("tipo", this.articuloRegistro.tipo);
                formdata.append("precio", this.articuloRegistro.precio);
                formdata.append("costo", this.articuloRegistro.costo);
                formdata.append("_method", "PATCH");
                axios.post('articulos/'+this.articuloRegistro.id, formdata).then(response => {
                    this.$emit('modificar');
                })
            },
            eliminar:function() {
                axios.post('articulos/'+this.articuloRegistro.id, {_method: 'delete'});
                this.$emit('eliminar');
            }
        }
    }
</script>

<style>
	.contenedor {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.5);
	}
	.cuadro {
		width: 80%;
		margin: 20% auto;
	}
	.titulo {
		background-color: burlywood;
	}
	.datos {
		background-color: lemonchiffon;
	}
	.cierre {
		float: right;
	}
	.aceptar {
		text-align: center;
		background-color: mediumspringgreen;
	}
</style>