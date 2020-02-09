<template>
    <div class="collection-posts-view">
        <h1 id="title">{{ collection.name }}</h1>
        <posts-container :posts="posts">
            <template slot="title">
                <h1 id="title"> {{ collection.name }} </h1>
            </template>
        </posts-container>
    </div>
</template>

<script>
    import PostsCardContainer from '@components/Post/PostCardContainer.vue'

    export default {
        data: function() {
            return {
                collection: {},
                posts: []
            }
        },
        mounted () {
            let collectionSlug = this.$route.params.slug;
            this.$api.get('collection').detail(collectionSlug).then(response => this.collection = response.data);
            this.$api.get('collection').posts(collectionSlug).then(response => this.posts = response.data);
        },
        components: {
            PostsContainer: PostsCardContainer
        }
    }
</script>

<style scoped>
    #title {
        margin-left: 20px;
    }
</style>
