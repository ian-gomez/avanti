<template>
    <div class="container">
            <div>
                <h1>Empleados</h1>
                <input type="text" class="form-control" name="busqueda" v-model="busqueda" placeholder="Buscar...">
            </div>
                <div class="card">
                  <button class="btn btn-info btn-block" @click="operacion=1; registrousers=[]">Ingresar</button>
                   <table id="tabla" class="display; color">
                    <thead>
                       <tr>
                           <td>ID</td>
                           <td>Name</td>
                           <td>Email</td>
                           <td>Acciones</td>
                       </tr>
                    </thead>
                      <tbody>
                        <tr v-for="(user, index) in buscausers">
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>
                                <button class="btn btn-warning btn-large" @click="operacion=2;registrousers=user">Editar</button>
                                <button class="btn btn-danger btn-large" @click="pos=index;operacion=3;registrousers=user">Borrar</button>
                            </td>
                        </tr>
                      </tbody>
                  </table>
                  <user-formulario @useralta="altauser($event)" @userbaja="bajauser()" @usereditar="editaruser($event)"
                  @cerrar-ventana="operacion=0"
                        v-if="operacion>0" 
                        :operacion="operacion"
                        :registrousers="registrousers">
                    </user-formulario>
                </div>
    </div>
</template>

<script>
    import datatables from 'datatables'
    export default{
        data(){
            return{
                operacion:0,
                users:[],
                busqueda:'',
                registrousers:[],
                pos:0,

            }
        },
        mounted() {
            this.mostraruser();
        },
        computed:{
            buscausers:function(){
            return this.users.filter(
            (user)=>user.name.includes(this.busqueda)
                );
            }
        },
        methods:{
            altauser:function(dato){
               this.users.push(dato);
               this.operacion=0;
               window.location.reload(true);
            },
            mostraruser:function(){
                axios.get('users').then(response =>{
                    this.users = response.data;
                    this.tabla();
                });
            },
            editaruser:function(dato){
                this.operacion=0;   
            },
            bajauser:function(){
                this.users.splice(this.pos,1);
                this.operacion=0;
                window.location.reload(true);
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
