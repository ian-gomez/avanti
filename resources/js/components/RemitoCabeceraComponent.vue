<template>
    <div class="con-tenedor">
            <div>
                <input type="text" class="form-control" name="busqueda" v-model="busqueda" placeholder="Buscar...">
            </div>
            <div class="col-md-8">
                <div class="card">
                  <button class="btn btn-info btn-block" @click="operacion=1; registroremitos=[]">Ingresar</button>
                   <table id="tabla" class="display; color">
                    <thead>
                       <tr>
                           <td>ID</td>
                           <td>Importe</td>
                       </tr>
                    </thead>
                      <tbody>
                        <tr v-for="(remito, index) in buscaremitos">
                            <td>{{remito.id}}</td>
                            <td>{{remito.importe}}</td>
                            <td>
                                <button class="btn btn-warning btn-large" @click="operacion=2;registroremitos=remito">Editar</button>
                                <button class="btn btn-danger btn-large" @click="pos=index;operacion=3;registroremitos=remito">Borrar</button>
                            </td>
                        </tr>
                      </tbody>
                  </table>
                  <remito-cabecera-formulario-component @remitoalta="altaremito($event)" @remitobaja="bajaremito()" @remitoeditar="editarremito($event)"
                  @cerrar-ventana="operacion=0"
                        v-if="operacion>0" 
                        :operacion="operacion"
                        :registroremitos="registroremitos">
            </remito-cabecera-formulario-component>
                </div>
            </div>
    </div>
</template>

<script>
    import datatables from 'datatables'
    export default{
        data(){
            return{
                operacion:0,
                remitos:[],
                busqueda:'',
                registroremitos:[],
                pos:0,

            }
        },
        mounted() {
            console.log('Component mounteda.');
            this.mostrarremito();
        },
        computed:{
            buscaremitos:function(){
            return this.remitos.filter(
            (remito)=>remito.name.includes(this.busqueda)
                );
            }
        },
        methods:{
            altaremito:function(dato){
                alert("hhhh");
               this.remitos.push(dato);
               this.operacion=0;
            },
            mostrarremito:function(){
                axios.get('remitos-cabecera').then(response =>{
                  console.log(response.data);
                    this.remitos = response.data;
                    this.tabla();
                });
            },
            editarremito:function(dato){
                console.log(dato); 
                this.operacion=0;   
            },
            bajaremito:function(){
                this.remitos.splice(this.pos,1);
                this.operacion=0;
            },
            tabla:function(){
                $(document).ready( function () {
                $('#tabla').DataTable({
                    "scrollY":        "500px",
                    "scrollCollapse": true,
                    "paging":         false,

                    
                        language:{
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
                } );
            }
        }
       } 
</script>