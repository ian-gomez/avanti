<template>
    <div class="container">
        <button @click="operacion=1;cabecerasR=[]" class="btn btn-success btn-block">Ingresar</button>
        <table class="table table-dark">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Importe</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cabecera, index) in cabeceras">
                    <td>{{cabecera.id}}</td>
                    <td>{{cabecera.importe}}</td>
                    <td><button class="btn btn-info"
                    @click="pos=index;operacion=2;cabecerasR=cabecera">Editar</button>
                    <button class="btn btn-danger" 
                    @click="pos=index;operacion=3;cabecerasR=cabecera">Borrar</button></td>
                </tr>
            </tbody>    
        </table>
        <stock-formulario-component 
                @alta="altacabecera($event)" 
                @baja="bajacabecera()"
                @editar="editarcabecera($event)" 
                @cerrar-ventana="operacion=0"
                v-if="operacion>0"
                :cabecerasR="cabecerasR"
                :operacion="operacion">
        </stock-formulario-component>
            <div class="datosm">
                <pre>{{$data}}</pre>
            </div>

    </div>
</template>

<script>
    export default {

        data(){
            return{
                operacion:0,
                pos:0,
                cabeceras:[],
                cabecerasR:[]
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.mostrar();
        },

        methods:{
            mostrar:function()
            {
                axios.get('stock-cabecera').then(respose =>{
                    this.cabeceras = respose.data
                });
            },
            altacabecera:function(dato)
            {
                this.cabeceras.push(dato);
                this.operacion=0;
            },
            editarcabecera:function(dato)
            {
                console.log(dato);
                this.operacion=0;
            },
            bajacabecera:function()
            {
                this.cabeceras.splice(this.pos,1);
                this.operacion=0;
            },
             
        }
    }
</script>
<style type="text/css">
    .datosm{
        background-color: gray;
        border-radius: 8px;
    }
</style>

