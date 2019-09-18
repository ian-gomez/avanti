<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="cerrar()">X</button>
        </div>
        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Cantidad</label>
            <input class="form-control" type="text" v-model="registrodetalles.cantidad">
            <br>
            <label>Precio</label>
            <input class="form-control" type="text" v-model="registrodetalles.precio">
            <br>
        </div>
        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Cantidad</label>
            <input class="form-control" type="text" v-model="registrodetalles.cantidad">
            <br>
            <label>Precio</label>
            <input class="form-control" type="text" v-model="registrodetalles.precio">
            <br>
        </div>
         <!-- Baja -->
        <div class="dato" v-if="operacion==3">
            ¿Está seguro que desea eliminar {{registrodetalles.cantidad}}?
        </div>
        <div class="aceptar">
            <button @click="operaciondetalle()">Aceptar</button>
        </div>
    </div>
</template>
<script>
   export default {
        props: ['operacion',"registrodetalles","remito_cabecera_id"],
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
            operaciondetalle:function(){
                if (this.operacion==1) {
                    this.altadetalle();
                };
                if (this.operacion==2) {
                    this.editardetalle();
                };
                if (this.operacion==3) {
                    this.bajadetalle();
                };
            },
            altadetalle:function(){
                let formdata = new FormData();
                formdata.append("remito_cabecera_id", this.remito_cabecera_id);
                formdata.append("cantidad", this.registrodetalles.cantidad);
                formdata.append("precio", this.registrodetalles.precio);
                axios.post('remitos-detalle',formdata).then(response => {
                    
                this.$emit('detallealta', response.data);
                })
            },
            editardetalle:function(){
                let formdata = new FormData();
                formdata.append("name",this.registrodetalles.name);
                formdata.append("email",this.registrodetalles.email);
                formdata.append("password",this.registrodetalles.password);
                formdata.append("_method","PATCH");
                axios.post('detalles/'+this.registrodetalles.id,formdata).then(response => {
                    console.log(response.data);
                this.$emit('detalleeditar', response.data);
                })
            },

            bajadetalle:function(){
                axios.delete('detalles/'+this.registrodetalles.id).then(response => {
                    this.$emit('detallebaja');
                })
            },
        }
      }  
</script>
