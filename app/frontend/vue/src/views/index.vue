<template>
    <div>
        <router-link
            v-for="(post, index) in posts"
            :key="post.id"
            :to="{name:'posts-slug', params: {slug: post.slug}}"
        >
            <post :post="post"></post>
        </router-link>

        <!-- Display more posts -->
        <router-link id="more" :to="{name:'posts-index'}">ver todos</router-link>
    </div>
</template>

<script>
    import Post from '@components/Post/Post.vue';

    const POST_LIMIT = 5;

    function limitChapterContent(chapter) {
        chapter.content = chapter.content.split('<hr')[0];
    }

    export default {
        name: 'home',
        data() {
            return {
                posts: []
            }
        },
        mounted() {
            this.$api.get('post').summary(POST_LIMIT).then(response => {
                var posts = response.data;
                for(var post of posts) {
                    limitChapterContent(post.chapters[0]);
                }

                this.posts = posts;
            }).then(response => this.$emit('loaded'));
        },
        components: {
            Post
        }
    }
</script>

<style scoped>
    .post {
        border-top: 1px solid var(--primary-color);
        border-width: 1px 0;
    }
    .separator {
        border: 1px solid var(--primary-color);
    }

    #more {
        display: block;

        margin-top: 20px;
        padding: 5px 10px;

        border: solid var(--primary-color);
        border-width: 1px 0;

        color: var(--primary-color);
        font-family: "Star Wars";
        font-weight: bolder;
        text-align: center;
        background-color: var(--second-background);

    }
</style>
