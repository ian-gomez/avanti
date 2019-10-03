<template>
    <div class="contenedor-rdetalle">
        <div class="titulo-detalle">
            <button class="btn btn-danger cierre-detalle" @click="$emit('cerrar-detalle')">X</button>
        </div>
        <div class="dato-detalle">
            <button class="btn btn-info btn-block" @click="operacion=1; registrodetalles=[]">Ingresar</button>
            <table id="tabla-detalle" class="display; color">
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
                        :registrodetalles="registrodetalles"></remito-detalle-formulario-component>
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
                axios.get('remitos-detalle/'+this.registroremitosb.id).then(response =>{
                    this.detalles = response.data;
                    this.tabla();
                });
            },
            cerrardetalle:function(){
                this.$emit('cerrar-detalle');
            }, 

            altadetalle:function(dato){
               this.detalles.push(dato);
               this.calculoImporte();
               this.operacion=0;
            },

            editardetalle:function(dato){
                this.calculoImporte();
                this.$emit('importe', this.importe); 
                this.operacion=0;   
            },
            bajadetalle:function(){
                this.detalles.splice(this.pos,1);
                this.calculoImporte();
                this.operacion=0;
            },
            calculoImporte:function() {
                this.importe = 0;
                for (let i = 0; i < this.detalles.length; i++) {
                    this.importe += this.detalles[i].precio * this.detalles[i].cantidad;
                };
                this.importe = Math.round(this.importe * 100) / 100;
                this.$emit('importe', this.importe);
            },
            tabla:function(){
                $(document).ready( function () {
                $('#tabla-detalle').DataTable({
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
    .contenedor-rdetalle {
        display: grid;
        grid-template-columns: 1fr 10fr 1fr;
        grid-template-rows: 1fr 1fr 9fr 1fr;
        grid-template-areas: 
        " . . ."
        " . titulo-detalle ."
        " . dato-detalle ."
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
    .dato-detalle {
        background-color: lemonchiffon;
        grid-area: dato-detalle;
    }
    .cierre-detalle {
        float: right;
    }
</style>
    