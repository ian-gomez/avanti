<template>
    <div class="contenedor-eliminados">
        <div class="titulo-eliminados">
            <button class="btn btn-danger cierre-eliminados" @click="$emit('cerrar-eliminados')">X</button>
        </div>
        <div class="datos-eliminados">
            <table class="display" id="tabla-eliminados">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Precio</td>
                        <td>Costo</td>
                        <td>Fecha de Eliminación</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(articuloEliminado, index) in articulosEliminados">
                        <td>{{articuloEliminado.nombre}}</td>
                        <td>{{articuloEliminado.precio}}</td>
                        <td>{{articuloEliminado.costo}}</td>
                        <td>{{articuloEliminado.deleted_at | moment("HH:mm DD/MM/YYYY")}}</td>
                        <td>
                            <button class="btn btn-success" @click="restaurar(articuloEliminado);pos=index">Restaurar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return{
                pos:0,
                articulosEliminados:[],
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('articulos-eliminados').then(response=>{
                    this.articulosEliminados = response.data;
                    this.tabla();
                })
            },
            restaurar:function(articulo) {
                const params = {
                    nombre: articulo.nombre,
                    tipo_id: articulo.tipo_id,
                    precio: articulo.precio,
                    costo: articulo.costo,
                    deleted_at: articulo.deleted_at,
                };
                axios.put('articulos-restaurar/' + articulo.id, params).then(response => {
                    this.$emit('restaurar', response.data);
                })
                this.articulosEliminados.splice(this.pos, 1)
            },
            tabla:function() {
                $(document).ready(function() {
                    $('#tabla-eliminados').DataTable({
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
	.contenedor-eliminados {
        display: grid;
        grid-template-columns: 1fr 10fr 1fr;
        grid-template-rows: 1fr 1fr 9fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo-eliminados ."
        " . datos-eliminados ."
        " . . .";
        position: fixed;
		top: 0;
		left: 0;
        width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.5);
	}
	.titulo-eliminados {
		background-color: burlywood;
        grid-area: titulo-eliminados;
	}
	.datos-eliminados {
		background-color: lemonchiffon;
        grid-area: datos-eliminados;
	}
	.cierre-eliminados {
		float: right;
	}
</style>