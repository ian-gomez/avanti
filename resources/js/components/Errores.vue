<template>
    <div>
        <label>Se han encontrado algunos errores:</label>
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