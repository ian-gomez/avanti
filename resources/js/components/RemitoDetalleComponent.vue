<template>
    <div class="conten">
            <div>
                <input type="text" class="form-control" name="busqueda" v-model="busqueda" placeholder="Buscar...">
            </div>
            <div class="col-md-8">
                <div class="card">
                  <button class="btn btn-info btn-block" @click="operacion=1; registrodetalles=[]">Ingresar</button>
                   <table id="tabla" class="display; color">
                    <thead>
                       <tr>
                           <td>ID</td>
                           <td>Precio</td>
                           <td>Cantidad</td>
                           <td>Acciones</td>
                       </tr>
                    </thead>
                      <tbody>
                        <tr v-for="(detalle, index) in detalles">
                            <td>{{detalle.id}}</td>
                            <td>{{detalle.precio}}</td>
                            <td>{{detalle.cantidad}}</td>
                            <td>
                                <button class="btn btn-warning btn-large" @click="operacion=2;registrodetalles=detalle">Editar</button>
                                <button class="btn btn-danger btn-large" @click="pos=index;operacion=3;registrodetalles=detalle">Borrar</button>
                            </td>
                        </tr>
                      </tbody>
                  </table>
                  <remito-detalle-formulario-component @detallealta="altadetalle($event)" @detallebaja="bajadetalle()" @detalleeditar="editardetalle($event)"
                  @cerrar-ventana="operacion=0"
                        v-if="operacion>0" 
                        :remito_cabecera_id="registroremitosb.id"
                        :operacion="operacion"
                        :registrodetalles="registrodetalles">
            </remito-detalle-formulario-component>
                </div>
            </div>
    </div>
</template>

<script>
    import datatables from 'datatables'
    export default{
        props: ["registroremitosb"],
        data(){
            return{
                operacion:0,
                detalles:[],
                busqueda:'',
                registrodetalles:[],
                pos:0,
                importe:0,

            }
        },
        mounted() {
            console.log('Component mounteda.');
            this.mostrardetalle();
        },
        computed:{
            buscardetalles:function(){
            return this.detalles.filter(
            (detalle)=>detalle.nombre.includes(this.busqueda)
                );
            }
        },
        methods:{
          mostrardetalle:function(){
            //console.log( this.registroremitosb);
                axios.get('remitos-detalle/'+this.registroremitosb.id).then(response =>{
                  console.log(response.data);
                    this.detalles = response.data;
                    this.tabla();
                });
            },
            cerrardetalle:function(){
                this.$emit('cerrar-detalle');
            }, 

            altadetalle:function(dato){
                alert("hhhh");
               this.detalles.push(dato);
               this.operacion=0;
            },

            editardetalle:function(dato){
                console.log(dato); 
                this.operacion=0;   
            },
            bajadetalle:function(){
                this.detalles.splice(this.pos,1);
                this.operacion=0;
            },
            calculoImporte:function() {
                this.importe = 0;
                for (let i = 0; i < this.detalle.length; i++) {
                    this.importe += this.detalle[i].precio * this.detalle[i].cantidad;
                };
                this.importe = Math.round(this.importe * 100) / 100;
                this.$emit('importe', this.importe);
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
<style>
    .conten {
        display: grid;
        grid-template-columns: 1fr 3fr 1fr;
        grid-template-rows: 1fr 1fr 3fr 1fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo ."
        " . dato ."
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
    .dato {
        background-color: lemonchiffon;
        grid-area: dato;
    }
    .cierre {
        float: right;
    }
    .aceptar {
        text-align: center;
        grid-area: aceptar;
    }
</style>
