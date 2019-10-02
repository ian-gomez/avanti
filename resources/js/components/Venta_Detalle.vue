<template>
    <div class="contenedor-detalle">
        <div class="titulo-detalle">
            <button class="btn btn-danger cierre-detalle" @click="$emit('cerrar-detalle')">X</button>
        </div>
        <div class="datos-detalle">
            <div>
                <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
            </div>
            <table class="display" id="tabla-detalle">
                <thead>
                    <tr>
                        <td>Articulo</td>
                        <td>Cantidad</td>
                        <td>Precio</td>
                        <td>Costo</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(ventaDetalle, index) in ventasDetalle">
                        <td>{{ventaDetalle.nombre}}</td>
                        <td>{{ventaDetalle.cantidad}}</td>
                        <td>{{ventaDetalle.precio}}</td>
                        <td>{{ventaDetalle.costo}}</td>
                        <td>
                            <button class="btn btn-warning" @click="formulario=2;asignar(ventaDetalle)">Editar</button>
                            <button class="btn btn-danger" @click="formulario=3;asignar(ventaDetalle);pos=index">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <venta-detalle-formulario
                v-if="formulario==1"
                :formulario="formulario"
                :ventaDetalleRegistro="[]"
                :venta_cabecera_id="ventaCabeceraRegistroB.id"
                @cerrar-formulario="formulario=0"
                @alta="alta($event);formulario=0"></venta-detalle-formulario>
            <venta-detalle-formulario
                v-if="formulario>1"
                :formulario="formulario"
                :ventaDetalleRegistro="ventaDetalleRegistro"
                @cerrar-formulario="formulario=0"
                @modificar="modificar();formulario=0"
                @eliminar="eliminar();formulario=0"></venta-detalle-formulario>
            </div>
    </div>
</template>

<script>
    export default {
        props: ['ventaCabeceraRegistroB'],
        data: function() {
            return{
                formulario:0,
                pos:0,
                ventasDetalle:[],
                ventaDetalleRegistro: '',
                importe:0,
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('ventas-detalle/'+ this.ventaCabeceraRegistroB.id).then(response=>{
                    this.ventasDetalle = response.data;
                    this.tabla();
                })
            },
            asignar:function(datos) {
                this.ventaDetalleRegistro = datos;
            },
            alta:function(datos) {
                this.ventasDetalle.push(datos);
                this.calculoImporte();
            },
            modificar:function() {
                this.calculoImporte();
            },
            eliminar:function() {
                this.ventasDetalle.splice(this.pos, 1)
                this.calculoImporte();
            },
            calculoImporte:function() {
                this.importe = 0;
                for (let i = 0; i < this.ventasDetalle.length; i++) {
                    this.importe += this.ventasDetalle[i].precio * this.ventasDetalle[i].cantidad;
                };
                this.importe = Math.round(this.importe * 100) / 100;
                this.$emit('importe', this.importe);
            },
            tabla:function() {
                $(document).ready(function() {
                    $('#tabla-detalle').DataTable({
                        "lengthMenu": [[5], [5]],
                        "pagingType": "full_numbers",
                        language: {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                });
            }
        }
    }
</script>

<style>
	.contenedor-detalle {
        display: grid;
        grid-template-columns: 1fr 10fr 1fr;
        grid-template-rows: 1fr 1fr 9fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo-detalle ."
        " . datos-detalle ."
        " . . .";
        position: fixed;
		top: 0;
		left: 0;
        width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.5);
	}
	.titulo-detalle {
		background-color: burlywood;
        grid-area: titulo-detalle;
	}
	.datos-detalle {
		background-color: lemonchiffon;
        grid-area: datos-detalle;
	}
	.cierre-detalle {
		float: right;
	}
</style>