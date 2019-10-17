<template>
	<div class="contenedor-cabecera1">
		<div class="datodetalle">
            <button @click="operaciond=1;det=[]" class="btn btn-success btn-block">Ingresar</button>
			<table class="display" id="tabla-detalle">
				<thead>
                	<tr>
                		<td>Articulo</td>
                    	<td>Cantidad</td>
                    	<td>Costo Unitario</td>
                        <td>Fecha</td>
                    	<td>Operaciones</td>
                	</tr>
            	</thead>
            	<tbody>
            		<tr v-for="(detalle, index) in detalleR">
	                    <td>{{detalle.nombre}}</td>
	                    <td>{{detalle.cantidad}}</td>
	                    <td>{{detalle.precio}}</td>
                        <td>{{detalle.fecha}}</td>
            			<td><button class="btn btn-danger" @click="operaciond=2; asignardetalle(detalle)" >Borrar</button></td>
                	</tr>
            	</tbody>
			</table>
			<button @click="cerrar()" class="botondetalle btn-block">X</button>
			<!--div style="background-color: white; border-radius: 10px;">
				<pre>{{$data}}</pre>
			</div-->	
		</div>
		<stock-detalle-formulario-component
				@altad='altadetalle($event)'
				@bajad="bajadetalle()"
				@cerrar-ventana="cerrar()"
				v-if="operaciond>0"
				:cabecera="cabecera.id"
                :detalled="detalled.id"
                :det="det"
				:operaciond="operaciond">
		</stock-detalle-formulario-component>
	</div>
</template>

<script>
	import datatables from 'datatables'
	export default{
		props: ["cabecera"],		
		data:function(){
            return{
            	detalleR:[],
            	pos:0,
            	operaciond:0,
				det:[],
                detalled:""
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.mostrard();
        },

        methods:{
        	cerrar:function()
            {
            	console.log(this.detalleR);
				this.operaciond=0;
            },
            asignardetalle:function(data){
                this.detalled = data;
            },
        	mostrard:function()
            {
                axios.get('stock-detalle/'+this.cabecera.id).then(respose =>{
            //    	console.log(respose.data);
                    this.detalleR = respose.data;
                    this.tabla();
                });
            },
            altadetalle:function(dato)
            {
                this.detalleR.push(dato);
                window.location.reload(true);
                this.operaciond=0;
            },
            bajadetalle:function()
            {
                this.detalleR.splice(this.pos,1);
                window.location.reload(true);
                this.operaciond=0;
            },
       	 	cerrar:function(){
                this.$emit('cerrar-detalle');
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
                            },
                        }
                    });
                });
            }
      	}  
	}

</script>

<style type="text/css">
    .contenedor-cabecera1{
        display: grid;
        grid-template-columns: 1fr 3fr 1fr;
        grid-template-rows: 1fr 3fr 1fr;
        grid-template-areas: 
        " . . ."
        " . datodetalle ."
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
    .botondetalle{
        font-weight: bold;
        font-size: 14px;
        height: 10%;
        border: solid gainsboro;
        background-color: ghostwhite;
    }
    .datodetalle {
        background-color: gainsboro;
        grid-area: datodetalle;
    }
</style>