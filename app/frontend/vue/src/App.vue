<template>
    <div id="app">
        <header id="header">
            <router-link :to="{name: 'index'}">
                <img id="header-logo" src="@/assets/images/logo.png"></img>
            </router-link>
        </header>
        <nav id="menu"></nav>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
      name: 'app',
    }
</script>

<style>
    @import '@/assets/style/theme.scss';

    body {
        margin: 0;

        background-image: url('assets/images/fondoestrellado.png')
    }

    header {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);

        height: 60px;
        width: 50%;
        padding: 10px 0;

        img {
            height: 100%;
        }
    }

    #content {
        margin-top: 60px;
        padding: 10px;
    }
</style>
