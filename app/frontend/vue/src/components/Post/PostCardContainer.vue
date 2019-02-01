<template>
    <card-container>
        <template slot="title">
            <slot name="title"></slot>
        </template>
        <card
            v-for="post in posts"
            :to="{ name: 'posts-slug', params: {slug: post.slug}}"
            :title="post.title"
            :image="post.image_url"
            :key="post.id"
        ></card>
    </card-container>
</template>

<script>
    import BaseCardContainer from '@components/BaseCardContainer.vue';
    import BaseCard from '@components/BaseCard.vue';

    export default {
        name: 'post-container',
        components: {
            'card-container': BaseCardContainer,
            'card': BaseCard
        },
        props:[
            'posts'
        ]
    }
</script>
