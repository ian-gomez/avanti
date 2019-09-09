<template>
    <div class="contenedor">
        <div class="titulo">
            <label>{{titulo}}</label>
            <button class="btn btn-danger cierre" @click="cerrar()">X</button>
        </div>
        <!-- Alta -->
        <div class="dato" v-if="operacion==1">
            <label>Importe:</label>
            <input class="form-control" type="text" v-model="registroremitos.importe">
            <label>Proveedor:</label>
            <select class="form-control" v-model="registroremitos.proveedor_id">
                <option v-for="proveedor in proveedores" v-bind:value="proveedor.id" v-bind:selected="(proveedor.id == opcionproveedor)">
                    {{proveedor.nombre}}
                </option>
            </select>
        </select>
        </div>
        <!-- Editar -->
        <div class="dato" v-if="operacion==2">
            <label>Importe:</label>
            <input class="form-control" type="text" v-model="registroremitos.importe">
        </div>
         <!-- Baja -->
        <div class="dato" v-if="operacion==3">
            ¿Está seguro que desea eliminar {{registroremitos.importe}}?
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
            console.log('Component mounted8888888888')
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
            return this.proveedores.filter(
            (prov)=>prov.id=dato
                );
            },            
            altaremito:function(){
                let formdata = new FormData();
                formdata.append("importe", this.registroremitos.importe);
                formdata.append("proveedor_id", this.registroremitos.proveedor_id);
                axios.post('remitos-cabecera',formdata).then(response => {
                    

                this.$emit('remitoalta',
                    {id:response.data.id,
                     importe:response.data.importe,
                     nombre:this.buscaprov(response.data.proveedor_id)[0].nombre}
                   );
                })
            },
             editarremito:function(){
                let formdata = new FormData();
                formdata.append("importe",this.registroremitos.importe);
                formdata.append("_method","PATCH");
                axios.post('remitos/'+this.registroremitos.id,formdata).then(response => {
                    //console.log(response.data);
                this.$emit('remitoeditar', response.data);
                })
            },

            bajaremito:function(){
                axios.delete('remitos/'+this.registroremitos.id).then(response => {
                    this.$emit('remitobaja');
                })
            },
        }
      }  
</script>
