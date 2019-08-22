<template>
    <div class="container">
        <div>
            <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
        </div>
        <table class="display" id="tabla">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Direccion</td>
                    <td>Telefono</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cliente, index) in clientes">
                    <td>{{cliente.nombre}}</td>
                    <td>{{cliente.direccion}}</td>
                    <td>{{cliente.telefono}}</td>
                    <td>
                        <button class="btn btn-warning" @click="formulario=2;asignar(cliente)">Editar</button>
                        <button class="btn btn-danger" @click="formulario=3;asignar(cliente);pos=index">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <cliente-formulario-component
            v-if="formulario==1"
            :formulario="formulario"
            :clienteRegistro="[]"
            @cerrar-ventana="formulario=0"
            @alta="alta($event);formulario=0"></cliente-formulario-component>
        <cliente-formulario-component
            v-if="formulario>1"
            :formulario="formulario"
            :clienteRegistro="clienteRegistro"
            @cerrar-ventana="formulario=0"
            @modificar="formulario=0"
            @eliminar="eliminar();formulario=0"></cliente-formulario-component>
    </div>
</template>

<script>
    import datatables from "datatables"
    export default {
        data: function() {
            return{
                formulario:0,
                pos:0,
                clientes:[],
                clienteRegistro:''
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('clientes').then(response=>{
                    this.clientes = response.data;
                    this.tabla();
                })
            },
            asignar:function(datos) {
                this.clienteRegistro = datos;
            },
            alta:function(datos) {
                this.clientes.push(datos);
            },
            eliminar:function() {
                this.clientes.splice(this.pos, 1)
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
