<template>
    <div id="container">
        <h1>Esta no es la página que estás buscando</h1>
        <img :src="img">
    </div>
</template>

<script>
    export default {
        mounted()
        {
            this.$emit('loaded');
        },
        computed: {
            img: function() {
                return require('@/assets/images/droids-' + (this.$store.state.theme.name == 'aliance' ? 'white' : 'black') + '.png');
            }
        },
    }
</script>

<style scoped>
    #container {
        text-align: center;
    }

    h1 {
        font-family: "Star Wars";
        font-size: 40px;
        color: var(--primary-color);
    }

    img {
        max-height: 60vh;
        background-color: var(--primary-color);
    }
</style>
