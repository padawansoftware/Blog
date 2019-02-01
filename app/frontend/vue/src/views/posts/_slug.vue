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
            this.$api.get('post').detail(postSlug).then(response => this.post = response.data);
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
