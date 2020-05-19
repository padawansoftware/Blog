<template>
    <div id="app" :data-theme="theme.name">
        <div id="preloader" :class="{hidden: hidePreloader}">
            <img :src="theme.img" class="loader">
        </div>

        <header id="header">
            <router-link :to="{name: 'index'}">
                Padawan Software
            </router-link>
        </header>
        <nav id="menu"></nav>
        <div id="content">
            <router-view @loaded="loaded"></router-view>
        </div>

        <button id="switch-theme" title="Cambiar tema" @click="switchTheme" :style="{ 'background-image': `url(${theme.img})` }"></button>

        <div v-if="cookieBar" id="cookie-bar">
            Como ya sabes, esta web almacena datos. <a @click="cookiesInfo" :href="cookiesRoute.href" target="_blank">Más info</a>

        </div>
    </div>
</template>

<script>
    import SettingsManager from '@/service/SettingsManager';
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
      // Properties
      data: function() {
        return {
            themeID: 0,
            hidePreloader: false
        };
      },
      computed: {
        theme: function() {
            return themes[this.themeID % themes.length]
        },
        cookieBar: function() {
            return ! SettingsManager.has('cookie-bar');
        },
        cookiesRoute: function() {
            return this.$router.resolve({name:'slug', params:{slug: 'cookies'}});
        }
      },
      // Lifecycle
      beforeMount() {
        let storedTheme = SettingsManager.get('theme');
        if (storedTheme) {
            this.themeID = storedTheme;
        }
      },
      watch: {
        '$route': 'loading'
      },
      // Methods
      methods: {
        switchTheme: function(event) {
            this.themeID++;
            SettingsManager.set('theme', this.themeID % themes.length);
        },
        cookiesInfo: function(event) {
            removeCookieBar(event);
        },
        loaded: function(event)
        {
            this.hidePreloader = true;
        },
        loading: function(event)
        {
            this.hidePreloader = false;
        }
      }
    }

    // Cookies bar
    function removeCookieBar(event)
    {
        var cookieBar = document.getElementById('cookie-bar');
        if (cookieBar) {
            cookieBar.parentNode.removeChild(cookieBar);
            document.removeEventListener('scroll', removeCookieBar);
            SettingsManager.set('cookie-bar', true);
        }
    }

    // Add on scroll element
    window.onload = function() {
        if (document.getElementById('cookie-bar')) {
            document.addEventListener('scroll', removeCookieBar);
        }
    };
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
