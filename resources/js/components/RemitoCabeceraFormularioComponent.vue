<template>
    <div class="contenedor">
        <div class="titulo">
            
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="cerrar()">X</button>
        </div>

        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Proveedor:</label>
            <select class="form-control" v-model="registroremitos.proveedor_id">
                <option v-for="proveedor in proveedores" v-bind:value="proveedor.id" v-bind:selected="(proveedor.id == opcionproveedor)">
                    {{proveedor.nombre}}
                </option>
            </select>
        </div>

        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Proveedor:</label>
            <select class="form-control" v-model="registroremitos.proveedor_id">
                <option v-for="proveedor in proveedores" v-bind:value="proveedor.id" v-bind:selected="(proveedor.id == opcionproveedor)">
                    {{proveedor.nombre}}
                </option>
            </select>
        </div>
        
        <div class="dato" v-if="operacion==3">
            ¿Está seguro que desea eliminar este remito?
        </div>
        

        <div class="aceptar">
            <button @click="operacionremito()">Aceptar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['operacion',"registroremitos"],
        data:function(){
            return{
             titulo:'',
             opcionproveedor:1,
             proveedores:[]
            }
        },
        mounted() {
            this.cargarProveedores();
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
            cargarProveedores:function() {
                axios.get('proveedores-datos').then(response=>{
                    this.proveedores = response.data
                    console.log(this.proveedores);
                })
            },

            cerrar:function(){
                this.$emit('cerrar-ventana');
            },   
            operacionremito:function(){
                if (this.operacion==1) {
                    this.altaremito();
                };
                if (this.operacion==2) {
                    this.editarremito();
                };
                if (this.operacion==3) {
                    this.bajaremito();
                };
            },

            buscaprov:function(dato){
                console.log(this.proveedores.filter((prov)=>prov.id==dato));
                return this.proveedores.filter((prov)=>prov.id==dato);
            },            

            altaremito:function(){
                let formdata = new FormData();
                formdata.append("proveedor_id", this.registroremitos.proveedor_id);
                axios.post('remitos-cabecera',formdata).then(response => {
                    this.$emit('remitoalta',
                    {id:response.data.id,
                     nombre:this.buscaprov(response.data.proveedor_id)[0].nombre}
                   );
                }).catch(error => {
                    if(error.response.status === 422) {
                        alert("campo/s incompletos")
                    }
                });

            },
             editarremito:function(){
                let formdata = new FormData();
                formdata.append("proveedor_id", this.registroremitos.proveedor_id);
                formdata.append("_method","PATCH");
                axios.post('remitos-cabecera/'+this.registroremitos.id,formdata).then(response => {
                this.$emit('remitoeditar',
                {id:response.data.id,
                 importe:this.registroremitos.importe,
                 nombre:this.buscaprov(response.data.proveedor_id)[0].nombre}
                );
                })
            },

            bajaremito:function(){
                axios.delete('remitos-cabecera/'+this.registroremitos.id).then(response => {
                    this.$emit('remitobaja');
                })
            },
        }
      }  
</script>
