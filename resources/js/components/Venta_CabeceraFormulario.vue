<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="$emit('cerrar-formulario')">X</button>
        </div>
        <!-- En caso de alta -->
        <div class="datos" v-if="formulario==1">
            <errores v-if="existenErrores" :errores="errores"></errores>
            <label>Número de Ticket</label>
            <input class="form-control" type="number" min="1" v-model="ventaCabeceraRegistro.numero_ticket">
            <label>Cliente:</label>
            <select class="form-control" v-model="opcionCliente">
                <option v-for="cliente in clientesOrdenados" v-bind:value="cliente.id" v-bind:selected="(cliente.id == opcionCliente)">
                    {{cliente.nombre}}
                </option>
            </select>
        </div>
        <!-- En caso de modificacion -->
        <div class="datos" v-else-if="formulario==2">
            <errores v-if="existenErrores" :errores="errores"></errores>
            <label>Número de Ticket</label>
            <input class="form-control" type="number" min="1" v-model="ventaCabeceraRegistro.numero_ticket">
            <label>Cliente:</label>
            <select class="form-control" v-model="ventaCabeceraRegistro.cliente_id">
                <option v-for="cliente in clientesOrdenados" v-bind:value="cliente.id" v-bind:selected="(cliente.id == ventaCabeceraRegistro.cliente_id)">
                    {{cliente.nombre}}
                </option>
            </select>
        </div>
        <!-- En caso de baja -->
        <div class="datos" v-else>
            ¿Está seguro que desea eliminar esta venta?
        </div>
        <div class="aceptar">
            <button class="bnt btn-success btn-block" @click="operacion()">Aceptar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ventaCabeceraRegistro', 'formulario'],
        data: function() {
            return{
                titulo:'',
                opcionCliente:1,
                clientes:[],
                existenErrores:false,
                errores: []
            }
        },
        mounted() {
            this.cargarClientes();
            if (this.formulario==1) {
                this.titulo='Ingresar nueva venta'
            };
            if (this.formulario==2) {
                this.titulo='Editar venta'
            };
            if (this.formulario==3) {
                this.titulo='Eliminar venta'
            };
        },
        computed: {
            clientesOrdenados: function() {
                return _.sortBy(this.clientes, 'nombre');
            }
        },
        methods: {
            cargarClientes:function() {
                axios.get('clientes').then(response=>{
                    this.clientes = response.data
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
                    cliente_id: this.opcionCliente,
                    numero_ticket: this.ventaCabeceraRegistro.numero_ticket,
                }
                axios.post('ventas-cabecera', params).then(response => {
                    this.$emit('alta', response.data);
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        this.errores = error.response.data.errors || {};
                    }
                });
            },
            modificar:function(){
                const params = {
                    cliente_id: this.ventaCabeceraRegistro.cliente_id,
                    numero_ticket: this.ventaCabeceraRegistro.numero_ticket,
                };
                axios.put('ventas-cabecera/'+this.ventaCabeceraRegistro.id, params).then(response => {
                    this.$emit('modificar', response.data);
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        this.errores = error.response.data.errors || {};
                    }
                });
            },
            eliminar:function() {
                axios.delete('ventas-cabecera/'+this.ventaCabeceraRegistro.id).then(response => {
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