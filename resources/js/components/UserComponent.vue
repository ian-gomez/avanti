<template>
    <div class="contenedor">
            <div>
                <input type="text" class="form-control" name="busqueda" v-model="busqueda" placeholder="Buscar...">
            </div>
            <div class="col-md-8">
                <div class="card">
                  <button class="btn btn-info btn-block" @click="operacion=1; registrousers=[]">Ingresar</button>
                   <table>
                       <tr>
                           <td>ID</td>
                           <td>Name</td>
                           <td>Email</td>
                           <td>Acciones</td>
                       </tr>
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
                  <user-formulario-component @useralta="altauser($event)" @userbaja="bajauser()" @usereditar="editaruser($event)" v-if="operacion>0" 
                        :operacion="operacion"
                        :registrousers="registrousers">
            </user-formulario-component>
                </div>
            </div>
    </div>
</template>

<script>
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
            console.log('Component mounted.');
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
            },
            mostraruser:function(){
                axios.get('users').then(response =>{
                  console.log(response.data);
                    this.users = response.data;
                });
            },
            editaruser:function(dato){
                console.log(dato);
            },
            bajauser:function(){
                this.users.splice(this.pos,1);
            },
        }
       } 
</script>
