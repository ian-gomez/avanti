<template>
    <div class="container">
        <div>
            <div>
                <button class="btn btn-primary btn-block" @click="formulario=1">Ingresar</button>
            </div>
            <table class="table table-bordered table-striped table-dark table-hover display">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Tipo</td>
                        <td>Precio</td>
                        <td>Costo</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(articulo, index) in articulos">
                        <td>{{articulo.nombre}}</td>
                        <td>{{articulo.tipo}}</td>
                        <td>{{articulo.precio}}</td>
                        <td>{{articulo.costo}}</td>
                        <td>
                            <button class="btn btn-warning" @click="formulario=2;asignar(articulo)">Editar</button>
                            <button class="btn btn-danger" @click="formulario=3;asignar(articulo);pos=index">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <articulo-formulario-component
             v-if="formulario==1"
             :formulario="formulario"
             :articuloRegistro="[]"
             @cerrar-ventana="formulario=0"
             @alta="alta($event);formulario=0"></articulo-formulario-component>
            <articulo-formulario-component
             v-if="formulario>1"
             :formulario="formulario"
             :articuloRegistro="articuloRegistro"
             @cerrar-ventana="formulario=0"
             @modificar="formulario=0"
             @eliminar="eliminar();formulario=0"></articulo-formulario-component>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return{
                formulario:0,
                pos:0,
                articulos:[],
                articuloRegistro:''
            }
        },
        mounted() {
            this.mostrar()
        },
        methods: {
            mostrar:function() {
                axios.get('articulos').then(response=>{
                    this.articulos = response.data
                })
            },
            asignar:function(datos) {
                this.articuloRegistro = datos;
            },
            alta:function(datos) {
                this.articulos.push(datos);
            },
            eliminar:function() {
                this.articulos.splice(this.pos, 1)
            }
        }
    }
</script>
