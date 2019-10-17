<template>
    <div class="contenedor-formulario1">
        <div class="datoformulario" v-if="operacion==1"> 
        <errores v-if="existenErrores" :errores="errores"></errores>  
            <br>
            <label>Proveedor:</label>
                <select class="form-control"v-model='opcionProveedor'>
                    <option v-for="proveedor in proveedores" v-bind:value='proveedor.id' v-bind:selected='(proveedor.id == cabecerasR.proveedor_id)'>{{proveedor.nombre}}</option>
                </select>
            <br>
            <label>Numero Remito:</label>
            <input class="form-control" v-model="cabecerasR.numero_remito" type="number" placeholder="Ingrese numero del remito" autofocus>
            <br>
            <button class="botonformulario btn-block" @click="operacioncabecera()">Aceptar</button>
            <button @click="cerrar()" class="botonformulario btn-block">X</button>
        </div>

        <div class="datoformulario" v-else-if="operacion==2"> 
        <errores v-if="existenErrores" :errores="errores"></errores>
            <br>     
            <label>Proveedor:</label>
                <select class="form-control"v-model='cabecerasR.proveedor_id'>
                    <option v-for="proveedor in proveedores" v-bind:value='proveedor.id' v-bind:selected='(proveedor.id == cabecerasR.proveedor_id)'>{{proveedor.nombre}}</option>
                </select>
            <br>
            <label>Numero Remito:</label>
            <input class="form-control" v-model="cabecerasR.numero_remito" type="number" placeholder="Ingrese numero del remito" autofocus>
            <br>
            <button class="botonformulario btn-block" @click="operacioncabecera()">Aceptar</button>
            <button @click="cerrar()" class="botonformulario btn-block">X</button>
        </div>

        <div class="datoformulario" v-else-if="operacion==3">
                <h2>¿Desea eliminar el registro del proveedor: </h2>
                <br><h2>{{cabecerasR.nombre}}?</h2>
                <br><button class="botonformulario btn-block" @click="operacioncabecera()">Aceptar</button>
                <button @click="cerrar()" class="botonformulario btn-block">X</button>  
        </div>
    </div>

</template>

<script>
    export default {
    	props: ['operacion',"cabecerasR"],
        data:function(){
            return{
                opcionProveedor:1,
                proveedores:[],
                existenErrores:false,
                errores: [],
                users:[]
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
            buscaprov:function(dato){
                return this.proveedores.filter((prov)=>prov.id==dato);
            },
            buscausers:function(dato){
                return this.users.filter((us)=>us.id==dato);
            },
            
            alta:function(){
                let formdata = new FormData();
                formdata.append("proveedor_id", this.opcionProveedor);
                formdata.append("numero_remito", this.cabecerasR.numero_remito);
                axios.post('stock-cabecera',formdata).then(response =>{
                this.$emit('alta',
                    {id:response.data.id,fecha:response.data.fecha,
                    numero_remito:response.data.numero_remito,
                    nombre:this.buscaprov(response.data.proveedor_id)[0].nombre}
                   );
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        this.errores = error.response.data.errors || {};
                    }
                });
            },
            baja:function(){
                axios.delete('stock-cabecera/'+this.cabecerasR.id).then(response => {
                    this.$emit('baja');
                })
            },
            editar:function(){           
                let formdata = new FormData();
                formdata.append("numero_remito", this.cabecerasR.numero_remito);
                formdata.append("proveedor_id", this.opcionProveedor);
                console.log (this.opcionProveedor);
                formdata.append("_method","PATCH");
                axios.post('stock-cabecera/'+this.cabecerasR.id,formdata).then(response => { this.$emit('editar',response.data);
                }).catch(error => {
                    this.existenErrores = true;
                    if(error.response.status === 422) {
                        this.errores = error.response.data.errors || {};
                    }
                });
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
            },
            usersnombre:function(){
                axios.get('users').then(respose =>{
                this.users = respose.data;
                });
            }
        }        
    }
</script>
<style type="text/css">
    .contenedor-formulario1{
        display: grid;
        grid-template-columns: 1fr 3fr 1fr;
        grid-template-rows: 1fr 3fr 1fr;
        grid-template-areas: 
        " . . ."
        " . datoformulario ."
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
    .botonformulario{
        font-weight: bold;
        font-size: 14px;
        height: 10%;
        border: solid gainsboro;
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
    .datoformulario{
        background-color: gainsboro;
        grid-area: datoformulario;
    }
</style>