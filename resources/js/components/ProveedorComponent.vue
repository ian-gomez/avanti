<template>
    <div class="container">
            <div>
                <input type="text" class="form-control" name="busqueda" v-model="busqueda" placeholder="Buscar...">
            </div>
                <div class="card">
                  <button class="btn btn-info btn-block" @click="operacion=1; registroproveedores=[]">Ingresar</button>
                   <table id="tabla" class="display; color">
                    <thead>
                       <tr>
                           <td>ID</td>
                           <td>Nombre</td>
                           <td>Telefono</td>
                           <td>Direccion</td>
                           <td>Acciones</td>
                       </tr>
                    </thead>
                      <tbody>
                        <tr v-for="(proveedor, index) in buscaproveedores">
                            <td>{{proveedor.id}}</td>
                            <td>{{proveedor.nombre}}</td>
                            <td>{{proveedor.telefono}}</td>
                            <td>{{proveedor.direccion}}</td>
                            <td>
                                <button class="btn btn-warning btn-large" @click="operacion=2;registroproveedores=proveedor">Editar</button>
                                <button class="btn btn-danger btn-large" @click="pos=index;operacion=3;registroproveedores=proveedor">Borrar</button>
                            </td>
                        </tr>
                      </tbody>
                  </table>
                  <proveedor-formulario-component @proveedoralta="altaproveedor($event)" @proveedorbaja="bajaproveedor()" @proveedoreditar="editarproveedor($event)"
                  @cerrar-ventana="operacion=0"
                        v-if="operacion>0" 
                        :operacion="operacion"
                        :registroproveedores="registroproveedores">
            </proveedor-formulario-component>
                </div>
    </div>
</template>


<script>
    import datatables from 'datatables'
    export default{
        data(){
            return{
                operacion:0,
                proveedores:[],
                busqueda:'',
                registroproveedores:[],
                pos:0,

            }
        },
        mounted() {
            this.mostrarproveedor();
        },
        computed:{
            buscaproveedores:function(){
            return this.proveedores.filter(
            (proveedor)=>proveedor.nombre.includes(this.busqueda)
                );
            }
        },
        methods:{
            altaproveedor:function(dato){
               this.proveedores.push(dato);
               this.operacion=0;
            },
            mostrarproveedor:function(){
                axios.get('proveedores-datos').then(response =>{
                    this.proveedores = response.data;
                    this.tabla();
                });
            },
            editarproveedor:function(dato){ 
                this.operacion=0;   
            },
            bajaproveedor:function(){
                this.proveedores.splice(this.pos,1);
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
