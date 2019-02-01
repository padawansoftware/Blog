<template>
    <card
        :to="to"
        :title="title"
        :image="image"
    >
        <span class="subtitle">{{ elements + " posts" }}</span>
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

<style scoped>
    .subtitle {
        display: block;

        margin-top: 5px;

        font-family: Rokkitt, serif;
        font-size: 14px;
        color: white;
    }
</style>
