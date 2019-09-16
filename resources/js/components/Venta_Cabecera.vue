<template>
    <div class="container">
        <div>
            <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
        </div>
        <table class="display" id="tabla">
            <thead>
                <tr>
                    <td>Número de Ticket</td>
                    <td>Empleado</td>
                    <td>Cliente</td>
                    <td>Fecha de Venta</td>
                    <td>Importe</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(ventaCabecera, index) in ventasCabecera">
                    <td>{{ventaCabecera.numero_ticket}}</td>
                    <td>{{ventaCabecera.user_nombre}}</td>
                    <td>{{ventaCabecera.cliente_nombre}}</td>
                    <td>{{ventaCabecera.created_at | moment("HH:mm DD/MM/YYYY")}}</td>
                    <td>{{ventaCabecera.importe}}</td>
                    <td>
                        <button class="btn btn-warning" @click="formulario=2;pos=index;asignar(ventaCabecera)">Editar</button>
                        <button class="btn btn-danger" @click="formulario=3;asignar(ventaCabecera);pos=index">Eliminar</button>
                        <button class="btn btn-info" @click="detalle=true;asignarB(ventaCabecera),pos=index">Detalle</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <venta-cabecera-formulario
            v-if="formulario==1"
            :formulario="formulario"
            :ventaCabeceraRegistro="[]"
            @cerrar-formulario="formulario=0"
            @alta="alta($event);formulario=0"></venta-cabecera-formulario>
        <venta-cabecera-formulario
            v-if="formulario>1"
            :formulario="formulario"
            :ventaCabeceraRegistro="ventaCabeceraRegistro"
            @cerrar-formulario="formulario=0"
            @modificar="modificar($event);formulario=0"
            @eliminar="eliminar();formulario=0"></venta-cabecera-formulario>
        <venta-detalle
         v-if="detalle"
         :ventaCabeceraRegistroB="ventaCabeceraRegistroB"
         @cerrar-detalle="detalle=false"
         @importe="actualizarImporte($event)"></venta-detalle>
    </div>
</template>

<script>
    import datatables from "datatables"
    export default {
        data: function() {
            return{
                formulario:0,
                pos:0,
                ventasCabecera:[],
                ventaCabeceraRegistro:'',
                ventaCabeceraRegistroB:'',
                detalle:false
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('ventas-cabecera-datos').then(response=>{
                    this.ventasCabecera = response.data;
                    this.tabla();
                })
            },
            asignar:function(datos) {
                this.ventaCabeceraRegistro = datos;
            },
            asignarB:function(datos) {
                this.ventaCabeceraRegistroB = datos;
            },
            alta:function(datos) {
                this.ventasCabecera.push(datos);
            },
            modificar:function(datos) {
                this.ventasCabecera[this.pos] = datos;
            },
            eliminar:function() {
                this.ventasCabecera.splice(this.pos, 1)
            },
            actualizarImporte:function(importe) {
                this.ventasCabecera[this.pos].importe = importe;
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
