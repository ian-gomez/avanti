<template>
    <div class="container">
        <div>
            <label>Articulos</label>
        </div>
        <div>
            <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
        </div>
        <table class="display" id="tabla">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Tipo</td>
                    <td>Precio</td>
                    <td>Costo</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(articulo, index) in articulos">
                    <td>{{articulo.nombre}}</td>
                    <td>{{articulo.tipo_nombre}}</td>
                    <td>{{articulo.precio}}</td>
                    <td>{{articulo.costo}}</td>
                    <td v-if="articulo.tipo_id==1">
                        <button class="btn btn-warning" @click="formulario=2;asignar(articulo)">Editar</button>
                        <button class="btn btn-danger" @click="formulario=3;asignar(articulo);pos=index">Eliminar</button>
                        <button class="btn btn-info" @click="insumos=true;asignarB(articulo)">Insumos</button>
                    </td>
                    <td v-else>
                        <button class="btn btn-warning" @click="formulario=2;asignar(articulo)">Editar</button>
                        <button class="btn btn-danger" @click="formulario=3;asignar(articulo);pos=index">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-secondary btn-block" @click="eliminados=true">Eliminados</button>
        <articulo-formulario
            v-if="formulario==1"
            :formulario="formulario"
            :articuloRegistro="[]"
            @cerrar-formulario="formulario=0"
            @alta="alta($event);formulario=0"></articulo-formulario>
        <articulo-formulario
            v-if="formulario>1"
            :formulario="formulario"
            :articuloRegistro="articuloRegistro"
            @cerrar-formulario="formulario=0"
            @modificar="formulario=0"
            @eliminar="eliminar();formulario=0"></articulo-formulario>
        <articulo-insumo
         v-if="insumos"
         :articuloRegistroB="articuloRegistroB"
         @cerrar-insumos="insumos=false"></articulo-insumo>
         <articulo-eliminado
          v-if="eliminados"
          @cerrar-eliminados="eliminados=false"
          @restaurar="restaurar($event)"></articulo-eliminado>
    </div>
</template>

<script>
    import datatables from 'datatables'
    export default {
        data: function() {
            return{
                formulario:0,
                pos:0,
                articulos:[],
                insumos:false,
                eliminados:false,
                articuloRegistro:'',
                articuloRegistroB:''
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('articulos').then(response=>{
                    this.articulos = response.data;
                    this.tabla();
                })
            },
            asignar:function(datos) {
                this.articuloRegistro = datos;
            },
            asignarB:function(datos) {
                this.articuloRegistroB = datos;
            },
            alta:function(datos) {
                this.articulos.push(datos);
            },
            eliminar:function() {
                this.articulos.splice(this.pos, 1)
            },
            restaurar:function(datos) {
                this.articulos.push(datos);
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
