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
            <select class="form-control" v-model="opcionArticulo">
                <option v-for="articulo in articulos" v-bind:value="articulo.id" v-bind:selected="(articulo.id == opcionArticulo)">
                    {{articulo.nombre}}
                </option>
            </select>
        </div>
        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Cantidad</label>
            <input class="form-control" type="text" v-model="registrodetalles.cantidad">
            <br>
            <select class="form-control" v-model="opcionArticulo">
                <option v-for="articulo in articulos" v-bind:value="articulo.id" v-bind:selected="(articulo.id == opcionArticulo)">
                    {{articulo.nombre}}
                </option>
            </select>
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
             titulo:'',
             opcionArticulo:1,
             articulos:[]
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
            this.cargarArticulos();
        },
        methods:{
            cargarArticulos:function() {
                axios.get('articulos-datos').then(response=>{
                    this.articulos = response.data
                })
            },
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
                formdata.append("articulo_id", this.opcionArticulo);
                axios.post('remitos-detalle',formdata).then(response => {
                this.$emit('detallealta', response.data);
                })
            },
            editardetalle:function(){
                let formdata = new FormData();
                formdata.append("remito_cabecera_id", this.remito_cabecera_id);
                formdata.append("cantidad", this.registrodetalles.cantidad);
                formdata.append("articulo_id", this.registrodetalles.articulo_id);
                formdata.append("precio", this.registrodetalles.precio);
                formdata.append("_method","PATCH");
                axios.post('remitos-detalle/'+this.registrodetalles.id,formdata).then(response => {
                this.$emit('detalleeditar', response.data);
                })
            },

            bajadetalle:function(){
                axios.delete('remitos-detalle/'+this.registrodetalles.id).then(response => {
                    this.$emit('detallebaja');
                })
            },
        }
      }  
</script>
