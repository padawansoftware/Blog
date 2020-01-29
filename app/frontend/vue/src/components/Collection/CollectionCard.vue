<template>
    <card
        :to="to"
        :title="title"
        :image="image"
    >
        <template slot="subtitle">
            {{ elements + " posts" }}
        </template>
    </card>
</template>

<script>
    import BaseCard from '@components/BaseCard.vue';

    export default {
        extends: BaseCard,
        components: {
            card: BaseCard
        },
        props: [
            'elements'
        ]
    }
</script>
