<template>
    <post-component :post="post">
        <template v-slot:title>
            <router-link :to="{name:'posts-slug', params: {slug: post.slug}}">
                <h1>{{ post.title }}</h1>
            </router-link>
        </template>

        <template v-slot:footer>
            <router-link class="more" :to="{name:'posts-slug', params: {slug: post.slug}}">Leer más</router-link>
        </template>
    </post-component>
</template>

<script>
    import PostComponent from '@components/Post/Post.vue';
    export default {
        name: 'post',
        props: [
            'post'
        ],
        components: {
            PostComponent
        }
    }
</script>

<style scoped>
    h1 {
        text-align: center;
        font-size: 40px;
        font-family: "Star Wars";
        text-transform: lowercase;
    }

    .post {
        padding-bottom: 50px;
    }

    .more {
        display: block;
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);

        padding: 5px 10px;
        width: 90%;

        text-align: center;
        border: 1px solid;

        color: var(--yellow);
        font-family: "Star Wars";
        font-weight: bolder;
    }
</style>
