<template>
    <div class="post-container">
        <post-component :post="post"></post-component>
        <div id="collections" v-if="post.collections && post.collections.length">
            <strong>Colecciones:</strong>
            <template v-for="(collection, index) in post.collections"   >
                <span class="code-tag">
                    <router-link :to="{name:'collections-slug-posts', params: {slug: collection.slug}}">{{collection.name}}</router-link>
                </span>
                &nbsp;
            </template>
        </div>
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
                postRepository.preview(postSlug, this.$route.query.preview).then(response => this.post = response.data).then(response => this.$emit('loaded'));
            } else {
                postRepository.detail(postSlug).then(response => this.post = response.data).then(response => this.$emit('loaded'));
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

    #collections {
        margin: 20px auto;
        border: 1px solid var(--primary-color);
        padding: 10px;
    }
</style>
