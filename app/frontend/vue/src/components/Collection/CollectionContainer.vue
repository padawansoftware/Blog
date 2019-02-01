<template>
    <card-container>
        <card
            v-for="collection in collections"
            :to="{ name: 'collections-slug-posts', params: {slug: collection.slug}}"
            :title="collection.name"
            :elements="collection.posts_length"
            :image="collection.image_url"
            :key="collection.id"
        ></card>
    </card-container>
</template>

<script>
    import BaseCardContainer from '@components/BaseCardContainer.vue';
    import BaseCard from '@components/BaseCard.vue';
    import CollectionCard from '@components/Collection/CollectionCard.vue';


    export default {
        components: {
            'card-container': BaseCardContainer,
            'card': CollectionCard,
        },
        props:[
            'collections'
        ]
    }
</script>
