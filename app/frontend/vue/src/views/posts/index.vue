<template>
    <div class="posts-view">
        <h1 id="title"> Todos los posts </h1>
        <post-container :posts="posts"></post-container>
    </div>
</template>

<script>
import PostCardContainer from '@components/Post/PostCardContainer.vue';

export default {
    name: 'posts',
    data() {
        return {
            posts: []
        }
    },
    components: {
        PostContainer: PostCardContainer
    },
    mounted() {
        this.$api.get('post').list().then(response => this.posts = response.data).then(response => this.$emit('loaded'));
    }
}
</script>

<style scoped>
    #title {
        margin-left: 20px;
    }
</style>
