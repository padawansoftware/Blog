<template>
    <button id="switch-theme" title="Cambiar tema" @click="switchTheme" :style="{ 'background-image': `url(${theme.img})` }"></button>
</template>

<script>
    import LocalStorageManager from '@/service/LocalStorageManager';

    const themes = [
        {
            name: "aliance",
            img: require("@/assets/images/aliance.png")
        },
        {
            name: "star-wars",
            img: require("@/assets/images/star-wars.png")
        },
        {
            name: "empire",
            img: require("@/assets/images/empire.png")
        }
    ];

    function getThemeFromLocalStorage() {
        return LocalStorageManager.get('theme');
    }

    export default {
        name: 'switch-theme',
        data: function() {
            return  {
                themeID: 0,
            }
        },
        beforeMount() {
            let storedTheme = getThemeFromLocalStorage();
            if (storedTheme) {
                this.themeID = storedTheme;
            }
            this.updateTheme();
        },
        computed: {
            theme: function() {
                return this.$state.theme;
            },
        },
        methods: {
            switchTheme: function(event) {
                this.themeID = (this.themeID + 1) % themes.length;
            },
            updateTheme: function() {
                this.$state.theme = themes[this.themeID];
            }
        },
        watch: {
            'themeID': function() {
                this.updateTheme();
                LocalStorageManager.set('theme', this.themeID);
            }
        }
    }
</script>

<style scoped>
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
