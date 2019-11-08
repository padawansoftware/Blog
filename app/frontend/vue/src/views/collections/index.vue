<template>
    <div>
        <h1 id="title"> Todas las colecciones </h1>
        <collection-container
            :collections="collections"
        ></collection-container>
    </div>
</template>

<script>
    import collectionContainer from '@components/Collection/CollectionContainer.vue';

    export default {
        name: 'collections',
        components: {
            collectionContainer
        },
        data: function() {
            return {
                collections: []
            }
        },
        mounted () {
            this.$api.get('collection').list().then(response => this.collections = response.data);
        }
    }
</script>
