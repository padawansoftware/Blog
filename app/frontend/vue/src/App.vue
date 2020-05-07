<template>
    <div id="app" :data-theme="theme.name">
        <header id="header">
            <router-link :to="{name: 'index'}">
                Padawan Software
            </router-link>
        </header>
        <nav id="menu"></nav>
        <div id="content">
            <router-view></router-view>
        </div>

        <button id="switch-theme" title="Cambiar tema" @click="switchTheme" :style="{ 'background-image': `url(${theme.img})` }"></button>
    </div>
</template>

<script>
    const themes = [
        {
            name: "star-wars",
            img: require("@/assets/images/star-wars.png")
        },
        {
            name: "aliance",
            img: require("@/assets/images/aliance.png")
        },
        {
            name: "empire",
            img: require("@/assets/images/empire.png")
        }
    ];

    export default {
      name: 'app',
      data: function() {
        return {
            themeID: 0,
        };
      },
      computed: {
        theme: function() {
            console.log(themes[this.themeID % themes.length])
            return themes[this.themeID % themes.length]
        }
      },
      methods: {
        switchTheme: function(event) {
            this.themeID++;
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
</style>

<style>
    @import '@/assets/style/theme.scss';
</style>
