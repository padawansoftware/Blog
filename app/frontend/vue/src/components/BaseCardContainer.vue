<template>
    <div class="card-container">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'card-container',
    }
</script>

<style scoped>
    .card-container {
        display: grid;
        grid-template-columns: repeat(3,1fr);
        grid-gap: 5px;
    }
</style>
