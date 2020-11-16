<template>
    <div>
        <div id="preloader" :class="{hidden: hidePreloader}">
            <img :src="this.$store.state.theme.img" class="loader">
        </div>
        <slot :loaded="loaded"></slot>
    </div>
</template>

<script>
    export default {
        name: 'preloader',
        data: function() {
            return {
                hidePreloader: false,
            };
        },
        watch: {
            '$route': 'loading'
        },
        methods: {
            loaded: function(event)
            {
                this.hidePreloader = true;
            },
            loading: function(event)
            {
                this.hidePreloader = false;
            },
        },
    }
</script>

<style scoped>
    #preloader {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999999;
        background: #000;

        [data-theme="aliance"] & {
            background: #fff;
        }

        &.hidden {
            visibility: hidden;
            opacity: 0;
            transition: all 400ms;
        }

        img {
            width: 50px;
            height: 50px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -13px;
            margin-left: -13px;
        }
    }
</style>
