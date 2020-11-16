<template>
    <div id="app" :data-theme="themeName">
        <preloader v-slot="preloader">
            <header id="header">
                <router-link :to="{name: 'index'}">
                    Padawan Software
                </router-link>
            </header>

            <div id="content">
                <router-view @loaded="preloader.loaded"></router-view>
            </div>
            <switch-theme></switch-theme>
            <cookie-bar></cookie-bar>
        </preloader>
    </div>
</template>

<script>
    import SwitchTheme from '@components/SwitchTheme.vue';
    import CookieBar from '@components/CookieBar.vue';
    import Preloader from '@components/Preloader.vue';

    export default {
        name: 'app',
        components: {
            Preloader,
            CookieBar,
            SwitchTheme
        },
        computed: {
            themeName() {
                return this.$state.theme.name
            }
        }
    }
</script>

<style scoped>
    #content {
        margin-top: 60px;
        padding: 10px;
    }

    header {
        font-family: "Star Wars";
    }

    #switch-theme {
        position: fixed;
        right: 20px;
        bottom: 10px;

        width: 30px;
        height: 30px;

        border: none;
        border-radius: 100%;
        opacity: 0.5;
        background: transparent center/cover;
        cursor: pointer;

        &:hover {
            opacity: 1;
        }

        &:focus, &:active {
            outline: 0;
            border: none;
            -moz-outline-style: none;
        };
    }

    #cookie-bar {
        position: fixed;
        bottom: 0;

        width: 100%;
        padding: 10px;

        text-align: center;
        background-color: black;
        border-top: 1px solid var(--primary-color);
    }

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

<style>
    @import '@/assets/style/theme.scss';
</style>
