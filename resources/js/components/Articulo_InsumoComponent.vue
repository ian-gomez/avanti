<template>
    <div class="contenedor-insumos">
        <div class="titulo-insumos">
            <label>{{articuloRegistroB.nombre}}</label>
            <button class="btn btn-danger cierre-insumos" @click="$emit('cerrar-insumos')">X</button>
        </div>
        <div class="datos-insumos">
            <div>
                <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
            </div>
            <table class="display" id="tabla-ai">
                <thead>
                    <tr>
                        <td>Insumo</td>
                        <td>Cantidad</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(articuloInsumo, index) in articulosInsumos">
                        <td>{{articuloInsumo.nombre}}</td>
                        <td>{{articuloInsumo.cantidad}}</td>
                        <td>
                            <button class="btn btn-warning" @click="formulario=2;asignar(articuloInsumo)">Editar</button>
                            <button class="btn btn-danger" @click="formulario=3;asignar(articuloInsumo);pos=index">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <articulo-insumo-formulario-component
                v-if="formulario==1"
                :formulario="formulario"
                :articuloInsumoRegistro="[]"
                :articulo_id="articuloRegistroB.id"
                @cerrar-formulario="formulario=0"
                @alta="alta($event);formulario=0"></articulo-insumo-formulario-component>
            <articulo-insumo-formulario-component
                v-if="formulario>1"
                :formulario="formulario"
                :articuloInsumoRegistro="articuloInsumoRegistro"
                @cerrar-formulario="formulario=0"
                @modificar="formulario=0"
                @eliminar="eliminar();formulario=0"></articulo-insumo-formulario-component>
            </div>
    </div>
</template>

<script>
    export default {
        props: ['articuloRegistroB'],
        data: function() {
            return{
                formulario:0,
                pos:0,
                articulosInsumos:[],
                articuloInsumoRegistro: ''
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('articulos-insumos/'+ this.articuloRegistroB.id).then(response=>{
                    this.articulosInsumos = response.data;
                    this.tabla();
                })
            },
            asignar:function(datos) {
                this.articuloInsumoRegistro = datos;
            },
            alta:function(datos) {
                this.articulosInsumos.push(datos);
            },
            eliminar:function() {
                this.articulosInsumos.splice(this.pos, 1)
            },
            tabla:function() {
                $(document).ready(function() {
                    $('#tabla-ai').DataTable({
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
	.contenedor-insumos {
        display: grid;
        grid-template-columns: 1fr 10fr 1fr;
        grid-template-rows: 1fr 1fr 9fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo-insumos ."
        " . datos-insumos ."
        " . . .";
        position: fixed;
		top: 0;
		left: 0;
        width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.5);
	}
	.titulo-insumos {
		background-color: burlywood;
        grid-area: titulo-insumos;
	}
	.datos-insumos {
		background-color: lemonchiffon;
        grid-area: datos-insumos;
	}
	.cierre-insumos {
		float: right;
	}
</style>