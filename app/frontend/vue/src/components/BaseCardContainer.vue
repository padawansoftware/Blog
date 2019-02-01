<template>
    <div>
        <slot name="title"></slot>
        <div class="container">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'card-container',
    }
</script>

<style scoped>
    .container {
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
