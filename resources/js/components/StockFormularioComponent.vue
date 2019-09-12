<template>
    <div class="contenedor">
        <div class="dato" v-if="operacion==1">
            <label>Fecha:</label>
            <input class="form-control" type="date" v-model="cabecerasR.fecha" autofocus>
            <br>
            <label>Proveedor:</label>
                <select class="form-control"v-model='cabecerasR.proveedor_id'>
                    <option v-for="proveedor in proveedores" v-bind:value='proveedor.id' v-bind:selected='(proveedor.id == cabecerasR.proveedor_id)'>{{proveedor.nombre}}</option>
                </select>
            <br>
            <label>Numero Remito:</label>
            <input class="form-control" v-model="cabecerasR.numero_remito" placeholder="Ingrese numero del remito" autofocus>
            <br>
            <button class="boton" @click="operacioncabecera()">Aceptar</button>
            <button @click="cerrar()" class="boton">X</button>
        </div>

        <div class="dato" v-else-if="operacion==2">
            <label>Fecha:</label>
            <input class="form-control" type="date" v-model="cabecerasR.fecha" autofocus>
            <br>
            <label>Proveedor:</label>
                <select class="form-control"v-model='cabecerasR.proveedor_id'>
                    <option v-for="proveedor in proveedores" v-bind:value='proveedor.id' v-bind:selected='(proveedor.id == cabecerasR.proveedor_id)'>{{proveedor.nombre}}</option>
                </select>
            <br>
            <label>Numero Remito:</label>
            <input class="form-control" v-model="cabecerasR.numero_remito" placeholder="Ingrese numero del remito" autofocus>
            <br>
            <button class="boton" @click="operacioncabecera()">Aceptar</button>
            <button @click="cerrar()" class="boton">X</button>
        </div>

        <div class="dato" v-else-if="operacion==3">
            <div class="datos">
                ¿Desea eliminar el id: {{cabecerasR.id}}?
                <br><button class="boton" @click="operacioncabecera()">Aceptar</button>
                <button @click="cerrar()" class="boton">X</button>  
            </div>
        </div>
    </div>

</template>

<script>
    export default {
    	props: ['operacion',"cabecerasR"],
        data:function(){
            return{
                opcionProveedor:1,
                proveedores:[]
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.proveedoresnombre();
        },

		methods:{


            cerrar:function(){
                this.$emit('cerrar-ventana');
            },    
            alta:function(){
                let formdata = new FormData();
                formdata.append("fecha", this.cabecerasR.fecha);
                formdata.append("proveedor_id", this.cabecerasR.proveedor_id);
                formdata.append("numero_remito", this.cabecerasR.numero_remito);
                axios.post('stock-cabecera',formdata).then(response =>{
                this.$emit('alta',response.data);
                })
            },
            baja:function(){
                axios.delete('stock-cabecera/'+this.cabecerasR.id).then(response => {
                    this.$emit('baja');
                })
            },
            editar:function(){           
                let formdata = new FormData();
                formdata.append("fecha",this.cabecerasR.fecha);
                formdata.append("_method","PATCH");
                axios.post('stock-cabecera/'+this.cabecerasR.id,formdata).then(response => {
                this.$emit('editar',response.data);
                })
            },

            operacioncabecera:function(){
                if (this.operacion == 1){
                    this.alta();
                };
                if (this.operacion == 3){
                    this.baja();            
                };
                if (this.operacion == 2){
                    this.editar();
                };
            },

            proveedoresnombre:function(){
                axios.get('proveedores').then(respose =>{
                this.proveedores = respose.data;
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
        width: 200px;
        border: solid gainsboro 20px;
        background-color: ghostwhite;
    }
    .x{
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: fixed;
        background-color: rgba(0,0,0,0.5);
        border: rgba(0,0,0,0.5);
    }
    .dato {
        background-color: gainsboro;
        grid-area: dato;
    }
    .vista-eliminar{
        background-color: green;
        grid-area: vista-eliminar;    
    }
    .vista-editar{
        
    }
</style>