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
        display: flex;
        flex-wrap: wrap;

        margin: 10px 5px;

        .card {
            width: calc(100%/3);
            height: calc(100vw/3/23*9); // Aspect ratio 23:9

            padding-right: 10px;
            padding-bottom: 10px;
        }
    }
</style>
