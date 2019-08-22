<template> 
	<div class="contenedor">
       <div class="box">
            <button class="boton" @click="operacioncabecera()">Aceptar</button>
            <input class="form-control clasedelimput" v-model="cabecerasR.importe" placeholder="Escriba el importe" autofocus>
            <button @click="cerrar()" class="boton">X</button>
       </div>   
    </div>
</template>

<script>
    export default {
    	props: ['operacion',"cabecerasR"],
        data:function(){
            return{

            }
        },
        mounted() {
            console.log('Component mounted.')

        },

		methods:{

            cerrar:function(){
                this.$emit('cerrar-ventana');
            },    
            alta:function(){
                let formdata = new FormData();
                formdata.append("importe", this.cabecerasR.importe);
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
                formdata.append("importe",this.cabecerasR.importe);
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
            }
        }        
    }
</script>
<style type="text/css">
    .contenedor{
            position: fixed;
            text-align: center;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }
    .clasedelimput{
        background-color: sienna;
        color: white;
        border-color: sienna;
    }
    .box{
        width: 28%;
        margin: 20% auto;
    }    
    .boton{
        font-weight: bold;
        font-size: 20px;
        width: 400px;
        border: solid 4px saddlebrown;
        background-color: burlywood;
    }
</style>