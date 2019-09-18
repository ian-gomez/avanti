<template>
	<div class="contenedor">
    	<div class="dato" v-if="operaciond==1">
            <label>Costo:</label>
            <input class="form-control" type="date" v-model="detalleRegistro.costo" autofocus>
            <br>
            <label>Articulo:</label>
                <select class="form-control"v-model='detalleRegistro.articulo_id'>
                    <option v-for="articulo in articulos" v-bind:value='articulo.id' v-bind:selected='(articulo.id == detalleRegistro.articulo_id)'>{{articulo.nombre}}</option>
                </select>
            <br>
            <label>Cantidad:</label>
            <input class="form-control" v-model="detalleRegistro.cantidad" placeholder="Ingrese la cantidad" autofocus>
            <br>
            <button class="boton" @click="operaciondetalle()">Aceptar</button>
            <button @click="cerrar()" class="boton">X</button>
        </div>

        <div class="dato" v-else-if="operaciondetalle==2">
            <div class="datos">
                ¿Desea eliminar articulo: {{articulo.nombre}}?
                <br><button class="boton" @click="operacioncabecera()">Aceptar</button>
                <button @click="cerrar()" class="boton">X</button>  
            </div>
        </div>
    </div>
</template>

<script>
    export default{
    	props: ["detalleR",'operaciond'],		
		data:function(){
            return{
            	detalleRegistro:[],
            	articulos:[]
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
            altad:function(){
                let formdata = new FormData();
                formdata.append("cantidad", this.detalleRegistro.cantidad);
                formdata.append("precio", this.detalleRegistro.precio);
                axios.post('stock-detalle',formdata).then(response =>{
                this.$emit('altad',response.data);
                })
            },
            bajad:function(){
                axios.delete('stock-detalle/'+this.detalleRegistro.id).then(response => {
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
    .contenedor{
        display: grid;
        grid-template-columns: 1fr 3fr 1fr;
        grid-template-rows: 1fr 1fr 3fr 1fr 1fr;
        grid-template-areas: 
        " . . ."
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
    .box{
        width: 28%;
        margin: 20% auto;
    }    
    .boton{
        font-weight: bold;
        font-size: 10px;
        width: 400px;
        border: solid gainsboro 20px;
        background-color: ghostwhite;
    }
    .dato {
        background-color: gainsboro;
        grid-area: dato;
    }
    .vista-eliminar{
        background-color: green;
        grid-area: vista-eliminar;    
    }
    
</style>