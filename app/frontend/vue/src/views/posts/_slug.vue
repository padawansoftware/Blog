<template>
    <div class="post-container">
        <post-component :post="post"></post-component>
    </div>
</template>

<script>
    import PostComponent from '@components/Post/Post.vue';
    export default {
        name: 'post',
        data() {
            return {
                post: []
            }
        },
        mounted() {
            let postSlug = this.$route.params.slug;
            let postRepository = this.$api.get('post');

            if('preview' in this.$route.query) {
                postRepository.preview(postSlug, this.$route.query.preview).then(response => this.post = response.data);
            } else {
                postRepository.detail(postSlug).then(response => this.post = response.data);
            }

        },
        components: {
            PostComponent
        }
    }
</script>

<style scoped>
    #footer {
        width: 70%;
        margin: auto;
    }
</style>
