<template>
    <div class="container">
        <div>
            <h1>Stock</h1>
        </div>
        <button @click="operacion=1;cabecerasR=[]" class="btn btn-success btn-block">Ingresar</button>
        <table class="display" id="tabla">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Usuario</td>
                    <td>Fecha</td>
                    <td>Proveedor</td>
                    <td>Numero Remito</td>
                    <td>Operaciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cabecera, index) in cabeceras">
                    <td>{{cabecera.id}}</td>
                    <td>{{cabecera.name}}</td>
                    <td>{{cabecera.fecha}}</td>
                    <td>{{cabecera.nombre}}</td>
                    <td>{{cabecera.numero_remito}}</td>
                    <td><button class="btn btn-info"
                    @click="pos=index;operacion=2;cabecerasR=cabecera">Editar</button>
                    <button class="btn btn-danger" 
                    @click="pos=index;operacion=3;cabecerasR=cabecera">Borrar</button>
                    <button @click="detalle=true;asignardetalle(cabecera)"class="btn btn-success">Detalle</button>
                </td>
                </tr>
            </tbody>    
        </table>
        <stock-formulario-component 
                @alta="altacabecera($event)" 
                @baja="bajacabecera()"
                @editar="editarcabecera($event)" 
                @cerrar-ventana="operacion=0"
                v-if="operacion>0"
                :cabecerasR="cabecerasR"
                :operacion="operacion">
        </stock-formulario-component>
            <!--div class="datosm">
                <pre>{{$data}}</pre>
            </div-->
        <stock-detalle-component
                @cerrar-detalle="detalle=false"
                v-if="detalle"
                :cabecera="cabecera">
        </stock-detalle-component>
    </div>

</template>

<script>
    import datatables from 'datatables'
    export default {

        data:function(){
            return{
                operacion:0,
                pos:0,
                cabeceras:[],
                detallev:"",
                detalle:false
               }
        },
        mounted() {
            console.log('Component mounted.');
            this.mostrar();
        },

        methods:{
            asignardetalle:function(dato)
            {
                this.cabecera = dato;
            },
            mostrar:function()
            {
                axios.get('stock-cabecera').then(respose =>{
                    this.cabeceras = respose.data;
                    this.tabla();
                });
            },
            altacabecera:function(dato)
            {
                this.cabeceras.push(dato);
                this.operacion=0;
                window.location.reload(true);
            },
            editarcabecera:function(dato)
            {
                console.log(dato);
                this.operacion=0;
            },
            bajacabecera:function()
            {
                this.cabeceras.splice(this.pos,1);
                this.operacion=0;
                window.location.reload(true);
            },

            tabla:function(){
                $(document).ready(function(){
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
<style type="text/css">
    .datosm{
        background-color: gray;
        border-radius: 8px;
    }
</style>

