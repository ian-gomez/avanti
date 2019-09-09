<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="cerrar()">X</button>
        </div>
        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="registroproveedores.nombre">
            <br>
            <label>Telefono</label>
            <input class="form-control" type="text" v-model="registroproveedores.telefono">
            <br>
            <label>Direccion</label>
            <input class="form-control" type="text" v-model="registroproveedores.direccion">
            <br>
        </div>
        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Nombre:</label>
            <input class="form-control" type="text" v-model="registroproveedores.nombre">
            <br>
            <label>Telefono</label>
            <input class="form-control" type="text" v-model="registroproveedores.telefono">
            <br>
            <label>Direccion</label>
            <input class="form-control" type="text" v-model="registroproveedores.direccion">
            <br>
        </div>
         <!-- Baja -->
        <div class="dato" v-if="operacion==3">
            ¿Está seguro que desea eliminar {{registroproveedores.nombre}}?
        </div>
        <div class="aceptar">
            <button @click="operacionproveedor()">Aceptar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['operacion',"registroproveedores"],
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
            operacionproveedor:function(){
                if (this.operacion==1) {
                    this.altaproveedor();
                };
                if (this.operacion==2) {
                    this.editarproveedor();
                };
                if (this.operacion==3) {
                    this.bajaproveedor();
                };
            },
            altaproveedor:function(){
                let formdata = new FormData();
                formdata.append("nombre", this.registroproveedores.nombre);
                formdata.append("telefono", this.registroproveedores.telefono);
                formdata.append("direccion", this.registroproveedores.direccion);
                axios.post('proveedores',formdata).then(response => {
                    
                this.$emit('proveedoralta', response.data);
                })
            },
             editarproveedor:function(){
                let formdata = new FormData();
                formdata.append("nombre",this.registroproveedores.nombre);
                formdata.append("telefono",this.registroproveedores.telefono);
                formdata.append("direccion",this.registroproveedores.direccion);
                formdata.append("_method","PATCH");
                axios.post('proveedores/'+this.registroproveedores.id,formdata).then(response => {
                    //console.log(response.data);
                this.$emit('proveedoreditar', response.data);
                })
            },

            bajaproveedor:function(){
                axios.delete('proveedores/'+this.registroproveedores.id).then(response => {
                    this.$emit('proveedorbaja');
                })
            },
        }
      }  
</script>
