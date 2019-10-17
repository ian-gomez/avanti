<template>
    <div>
        <label>Se han producido los siguientes errores:</label>
        <ul>
            <li v-for="error in errores">{{ error[0] }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['errores']
}
</script>
<style type="text/css">
	.errorcolor{
		
	}
</style>