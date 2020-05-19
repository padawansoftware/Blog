<template>
    <div id="container">
        <h1>Esta no es la página que estás buscando</h1>
        <img :src="this.img">
    </div>
</template>

<script>
    import State from '@/state.js';

    export default {
        data() {
            return {
                state: State,
                img: null
            };
        },
        mounted()
        {
            this.img = this.getImg();
            this.$emit('loaded');
        },
        watch: {
            "state.theme": function() {
                this.img = this.getImg();
            }
        },
        methods: {
            getImg() {
                return require('@/assets/images/droids-' + (this.state.theme.name == 'aliance' ? 'white' : 'black') + '.png');
            }
        }
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
