<template>
    <div class="container">
    	<div>
    		<label>{{titulo}}</label>
    	</div>
       	<div>
	       	<div class="row">
	       		<label>Nombre</label>
				<input v-model ="registrousers.name">
				<label>Email</label>
	            <input v-model ="registrousers.email">
	            <label>Password</label>
	            <input v-model ="registrousers.password">
	            <button @click="operacionuser()">Aceptar</button>
        	</div>
        </div>	
    </div>
</template>

<script>
   export default {
        props: ['operacion',"registrousers"],
        data:function(){
            return{
             titulo:''   
            }
        },
        mounted() {
            console.log('Component mounted.')
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

            operacionuser:function(){
                if (this.operacion==1) {
                    this.altauser();
                };
                if (this.operacion==2) {
                    this.editaruser();
                };
                if (this.operacion==3) {
                    this.bajauser();
                };
            },
            altauser:function(){
                let formdata = new FormData();
                formdata.append("name", this.registrousers.name);
                formdata.append("email", this.registrousers.email);
                formdata.append("password", this.registrousers.password);
                axios.post('users',formdata).then(response => {
                this.$emit('useralta', response.data);
                })
            },
             editaruser:function(){
                let formdata = new FormData();
                formdata.append("name",this.registrousers.name);
                formdata.append("email",this.registrousers.email);
				formdata.append("password",this.registrousers.password);
                formdata.append("_method","PATCH");
                axios.post('users/'+this.registrousers.id,formdata).then(response => {
                    console.log(response.data);
                this.$emit('usereditar', response.data);
                })
            },

            bajauser:function(){
                axios.delete('users/'+this.registrousers.id).then(response => {
                    this.$emit('userbaja');
                })
            },
        }
      }  
</script>

