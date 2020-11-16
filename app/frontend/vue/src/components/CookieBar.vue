<template>
    <div v-if="cookieBar" id="cookie-bar">
        Como ya sabes, esta web almacena datos. <a @click="cookiesInfo" :href="cookiesRoute.href" target="_blank">Más info</a>
    </div>
</template>

<script>
    import LocalStorageManager from '@/service/LocalStorageManager'

    export default {
        name: 'cookie-bar',
        computed: {
            cookieBar: function() {
                return ! isCookieBarSet()
            },
            cookiesRoute: function() {
                return this.$router.resolve({name:'slug', params:{slug: 'cookies'}});
            }
        },
        methods: {
            cookiesInfo: function(event) {
                removeCookieBar(event);
            }
        }
    };

    function removeCookieBar(event)
    {
        var cookieBar = document.getElementById('cookie-bar');
        if (cookieBar) {
            cookieBar.parentNode.removeChild(cookieBar);
            document.removeEventListener('scroll', removeCookieBar);
            LocalStorageManager.set('cookie-bar', true);
        }
    }

    function isCookieBarSet() {
        return LocalStorageManager.has('cookie-bar');
    }

    window.onload = function removeCookieBarOnScroll() {
        if (document.getElementById('cookie-bar')) {
            document.addEventListener('scroll', removeCookieBar);
        }
    };
</script>

<style scoped>
    #cookie-bar {
        position: fixed;
        bottom: 0;

        width: 100%;
        padding: 10px;

        text-align: center;
        background-color: black;
        border-top: 1px solid var(--primary-color);
    }
</style>
