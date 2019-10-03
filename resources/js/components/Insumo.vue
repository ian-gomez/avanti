<template>
    <div class="container">
        <div>
            <label>Insumos</label>
        </div>
        <div>
            <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
        </div>
        <table class="display" id="tabla">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Precio</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(insumo, index) in insumos">
                    <td>{{insumo.nombre}}</td>
                    <td>{{insumo.precio}}</td>
                    <td>
                        <button class="btn btn-warning" @click="formulario=2;asignar(insumo)">Editar</button>
                        <button class="btn btn-danger" @click="formulario=3;asignar(insumo);pos=index">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <insumo-formulario
            v-if="formulario==1"
            :formulario="formulario"
            :insumoRegistro="[]"
            @cerrar-ventana="formulario=0"
            @alta="alta($event);formulario=0"></insumo-formulario>
        <insumo-formulario
            v-if="formulario>1"
            :formulario="formulario"
            :insumoRegistro="insumoRegistro"
            @cerrar-ventana="formulario=0"
            @modificar="formulario=0"
            @eliminar="eliminar();formulario=0"></insumo-formulario>
    </div>
</template>

<script>
    import datatables from "datatables"
    export default {
        data: function() {
            return{
                formulario:0,
                pos:0,
                insumos:[],
                insumoRegistro:''
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('insumos').then(response=>{
                    this.insumos = response.data;
                    this.tabla();
                })
            },
            asignar:function(datos) {
                this.insumoRegistro = datos;
            },
            alta:function(datos) {
                this.insumos.push(datos);
                window.location.reload(true);
            },
            eliminar:function() {
                this.insumos.splice(this.pos, 1);
                window.location.reload(true);
            },
            tabla:function() {
                $(document).ready(function() {
                    $('#tabla').DataTable({
                        "lengthMenu": [[5, 25, 50], [5, 25, 50]],
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
