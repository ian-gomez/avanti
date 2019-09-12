<template>
	<div class="contenedor">
		<div class="dato">
			<table class="display" id="tabla-detalle">
				<thead>
                	<tr>
                		<td>Articulo</td>
                    	<td>Cantidad</td>
                    	<td>Precio</td>
                	</tr>
            	</thead>
            	<tbody>
            		<tr v-for="(detalle, index) in detalleR">
	                    <td>{{detalle.nombre}}</td>
	                    <td>{{detalle.cantidad}}</td>
	                    <td>{{detalle.precio}}</td>
                	</tr>
            	</tbody>
			</table>
			<button @click="cerrar()" class="boton">X</button>
			<div style="background-color: white; border-radius: 10px;">
				<pre>{{$data}}</pre>
			</div>	
		</div>
	</div>
</template>

<script>
	import datatables from 'datatables'
	export default{
		props: ['operacion','detallev'],		
		data:function(){
            return{
            	detalleR:[]
            }
        },
        mounted() {

            console.log('Component mounted.')
            this.mostrard();
            },

        methods:{

        	mostrard:function()
            {
                axios.get('stock-detalle').then(respose =>{
                    this.detalleR = respose.data;
                    this.tabla();
                });
            },
        
       	 	cerrar:function(){
                this.$emit('cerrar-ventana');
            },
        	detalle:function(){
                if (this.operacion == 4){
            	};
        	},
        	tabla:function(){
                $(document).ready(function(){
                    $('#tabla-detalle').DataTable({
                        "lengthMenu": [[5, 25, 50], [5, 25, 50]],
                        "pagingType": "full_numbers",
                        language: {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla-detalle",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
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
    .vista-select{

    }
</style>