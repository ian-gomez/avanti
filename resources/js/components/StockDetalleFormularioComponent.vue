<template>
	<div class="contenedor">
		<div class="dato">
			<button @click="cerrar()" class="boton">X</button>	
		</div>
	</div>
</template>

<script>
	export default{
		props: ['operacion','detallev'],		
		data:function(){
            return{

            }
        },
        mounted() {
            console.log('Component mounted.')

        },
        cerrar:function(){
                this.$emit('cerrar-ventana');
            },
        detalle:function(){
                if (this.operacion == 4){

                };
        },
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