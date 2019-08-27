<template>
    <div class="contenedor">
    	<div class="titulo">
    		<label>{{titulo}}</label>
    	</div>
        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="registrousers.name">
            <br>
            <label>Email</label>
            <input class="form-control" type="text" v-model="registrousers.email">
            <br>
            <label>Password</label>
            <input class="form-control" type="text" v-model="registrousers.password">
            <br>
        </div>
        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="registrousers.name">
            <br>
            <label>Email</label>
            <input class="form-control" type="text" v-model="registrousers.email">
            <br>
            <label>Password</label>
            <input class="form-control" type="text" v-model="registrousers.password">
            <br>
        </div>
        <!-- Baja -->
        <div class="dato" v-if="operacion==3">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="registrousers.name">
            <br>
            <label>Email</label>
            <input class="form-control" type="text" v-model="registrousers.email">
            <br>
            <label>Password</label>
            <input class="form-control" type="text" v-model="registrousers.password">
            <br>
        </div>
        <div class="aceptar">
            <button @click="operacionuser(); cerrar()">Aceptar</button>
            <button @click="cerrar()" class="boton">X</button>
        </div>
    </div>
</template>

<script>
   export default {
        props: ['operacion',"registrousers"],
        data:function(){
            return{
             titulo:''   
            }
        },
        mounted() {
            console.log('Component mounted8888888888')
              if (this.operacion==1) {
                    this.titulo="Alta";
                };
                if (this.operacion==2) {
                    this.titulo="Editar";
                };
                if (this.operacion==3) {
                    this.titulo="Baja";
                };
        },
        methods:{
            cerrar:function(){
                this.$emit('cerrar-ventana');
            },   
            operacionuser:function(){
                if (this.operacion==1) {
                    this.altauser();
                };
                if (this.operacion==2) {
                    this.editaruser();
                };
                if (this.operacion==3) {
                    this.bajauser();
                };
            },
            altauser:function(){
                let formdata = new FormData();
                formdata.append("name", this.registrousers.name);
                formdata.append("email", this.registrousers.email);
                formdata.append("password", this.registrousers.password);
                axios.post('users',formdata).then(response => {
                    
                this.$emit('useralta', response.data);
                })
            },
             editaruser:function(){
                let formdata = new FormData();
                formdata.append("name",this.registrousers.name);
                formdata.append("email",this.registrousers.email);
				formdata.append("password",this.registrousers.password);
                formdata.append("_method","PATCH");
                axios.post('users/'+this.registrousers.id,formdata).then(response => {
                    //console.log(response.data);
                this.$emit('usereditar', response.data);
                })
            },

            bajauser:function(){
                axios.delete('users/'+this.registrousers.id).then(response => {
                    this.$emit('userbaja');
                })
            },
        }
      }  
</script>
<style>
    .contenedor {
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