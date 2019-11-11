<template>
    <div class="post-container">
        <div
            v-for="post in posts"
            :key="post.id"
        >
            <post :post="post"></post>
        </div>

        <router-link id="more" :to="{name:'posts-index'}">ver más</router-link>
    </div>
</template>

<script>
    import Post from '@components/Index/Post.vue';

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
            });
        },
        components: {
            Post
        }
    }
</script>

<style scoped>
    #more {
        display: block;

        padding: 5px 10px;
        margin-bottom: 20px;

        text-align: center;
        border: 1px solid;

        color: var(--yellow);
        font-family: "Star Wars";
        font-weight: bolder;
    }
</style>
