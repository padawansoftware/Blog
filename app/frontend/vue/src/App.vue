<template>
    <div id="app" :data-theme="this.$store.state.theme.name">
        <preloader v-slot="preloader">
            <header id="header">
                <router-link :to="{name: 'index'}" class="logo">
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
        }
    }
</script>

<style scoped>
    @import '@/assets/style/variables.scss';

    #app {
        padding: 20px 0 50px 0;
    }

    header {
        max-width: $max-width;
        width: $width;
        margin: auto;
        margin-bottom: 100px;
        font-family: "Star Wars";
    }

    #content {
        max-width: $max-width;
        width: $width;
        margin: auto;
    }
</style>

<style>
    @import '@/assets/style/theme.scss';
</style>
