<template>
	<div class="contenedor-detalle1">
    	<div class="datos-formulario-detalle-" v-if="operaciond==1">
            <errores v-if="existenErrores" :errores="errores"></errores>
            <label>Articulo:</label>
                <select class="form-control"v-model='opcionArticulo'>
                    <option v-for="articulo in articulos" v-bind:value='articulo.id' v-bind:selected='(articulo.id == det.articulo_id)'>{{articulo.nombre}}</option>
                </select>
            <br>
            <label>Cantidad:</label>
            <input class="form-control" v-model="det.cantidad" placeholder="Ingrese la cantidad" type="number" autofocus>
            <br>
            <button class="botondetalleform btn-block" @click="operaciondetalle()">Aceptar</button>
            <button @click="cerrar()" class="botondetalleform btn-block">X</button>
        </div>

        <div class="datos-formulario-detalle-" v-else-if="operaciond==2">
                <h2>¿Desea eliminar?</h2>
                <br><button class="botondetalleform btn-block" @click="operaciondetalle()">Aceptar</button>
                <button @click="cerrar()" class="botondetalleform btn-block">X</button>  
        </div>
    </div>
</template>

<script>
    export default{
    	props: ["detalled","cabecera",'operaciond',"det"],		
		data:function(){
            return{
            	articulos:[],
                existenErrores:false,
                errores: [],
            	opcionArticulo:1
            }
        },
         mounted() {
            console.log('Component mounted.')
            this.articulonombre();
        },

        methods:{ 
        	cerrar:function(){
                this.$emit('cerrar-ventana');
            },
            buscart:function(dato){
                return this.articulos.filter((art)=>art.id==dato);
            },      
            altad:function(){
                let formdata = new FormData();
                formdata.append("cantidad", this.det.cantidad);
                formdata.append("articulos_id", this.opcionArticulo);
                formdata.append("stock_cabecera_id", this.cabecera);
                axios.post('stock-detalle',formdata).then(response =>{
                this.$emit('altad',
                    {id:response.data.id,
                    cantidad:response.data.cantidad,
                    precio:response.data.precio,
                    nombre:this.buscart(response.data.articulo_id)[0].nombre}
                   );
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        this.errores = error.response.data.errors || {};
                    }
                });
            },
            bajad:function(){
                axios.delete('stock-detalle/'+this.detalled).then(response => {
                    this.$emit('bajad');
                })
            },

            operaciondetalle:function(){
                if (this.operaciond == 1){
                    this.altad();
                };
                if (this.operaciond == 2){
                    this.bajad();            
                };
            },
            articulonombre:function(){
                axios.get('articulos').then(respose =>{
                this.articulos = respose.data;
                });
            }
        }
    }
</script>

<style type="text/css">
    .contenedor-detalle1{
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        grid-template-rows: 1fr 2fr 1fr;
        grid-template-areas: 
        " . . ."
        " . datos-formulario-detalle- ."
        " . . .";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    .box{
        width: 28%;
        margin: 20% auto;
    }    
    .botondetalleform{
        font-weight: bold;
        font-size: 14px;
        height: 10%;
        border: solid gainsboro;
        background-color: ghostwhite;
    }
    .datos-formulario-detalle- {
        background-color: gainsboro;
        grid-area: datos-formulario-detalle-;
    }
</style>