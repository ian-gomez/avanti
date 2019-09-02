<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="cerrar()">X</button>
        </div>
        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Importe:</label>
            <input class="form-control" type="text" v-model="registroremitos.importe">
            <label>User:</label>
            <select class="form-control" v-model="opcionuser">
                <option v-for="user in users" v-bind:value="user.id" v-bind:selected="(user.id == opcionuser)">
                    {{user.name}}
                </option>
            </select>
        </select>
        </div>
        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Importe:</label>
            <input class="form-control" type="text" v-model="registroremitos.importe">
        </div>
         <!-- Baja -->
        <div class="dato" v-if="operacion==3">
            ¿Está seguro que desea eliminar {{registroremitos.importe}}?
        </div>
        <div class="aceptar">
            <button @click="operacionremito()">Aceptar</button>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['operacion',"registroremitos"],
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
            operacionremito:function(){
                if (this.operacion==1) {
                    this.altaremito();
                };
                if (this.operacion==2) {
                    this.editarremito();
                };
                if (this.operacion==3) {
                    this.bajaremito();
                };
            },
            altaremito:function(){
                let formdata = new FormData();
                formdata.append("importe", this.registroremitos.importe);
                formdata.append("user_id", this.registroremitos.user_id);
                formdata.append("proveedor_id", this.registroremitos.proveedor_id);
                axios.post('remitos-cabecera',formdata).then(response => {
                    
                this.$emit('remitoalta', response.data);
                })
            },
             editarremito:function(){
                let formdata = new FormData();
                formdata.append("importe",this.registroremitos.importe);
                formdata.append("_method","PATCH");
                axios.post('remitos/'+this.registroremitos.id,formdata).then(response => {
                    //console.log(response.data);
                this.$emit('remitoeditar', response.data);
                })
            },

            bajaremito:function(){
                axios.delete('remitos/'+this.registroremitos.id).then(response => {
                    this.$emit('remitobaja');
                })
            },
        }
      }  
</script>
</script>