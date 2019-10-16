<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="cerrar()">X</button>
        </div>
        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Nombre:</label>
            <input class="form-control" type="text"  v-model="registroproveedores.nombre" required>
            <br>
            <label>Telefono</label>
            <input class="form-control" type="text" v-model="registroproveedores.telefono" required>
            <br>
            <label>Direccion</label>
            <input class="form-control" type="text" v-model="registroproveedores.direccion" required>
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
             titulo:'',
             existenErrores:false,
             errores:[]   
            }
        },
        mounted() {
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
                const params = {
                    nombre: this.registroproveedores.nombre,
                    direccion: this.registroproveedores.direccion,
                    telefono: this.registroproveedores.telefono,
                }
                axios.post('proveedores',params).then(response => {
                this.$emit('proveedoralta', response.data);
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        alert("campo/s incompletos")
                    }
                });

            },
             editarproveedor:function(){
                 const params = {
                    nombre: this.registroproveedores.nombre,
                    direccion: this.registroproveedores.direccion,
                    telefono: this.registroproveedores.telefono,
                }
                axios.put('proveedores/'+this.registroproveedores.id, params).then(response => {
                    this.$emit('proveedoreditar');
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        alert("campo/s incompletos")
                    }
                });
            },

            bajaproveedor:function(){
                axios.delete('proveedores/'+this.registroproveedores.id).then(response => {
                    this.$emit('proveedorbaja');
                })
            },
        }
      }  
</script>
