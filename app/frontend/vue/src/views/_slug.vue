<template>
    <div class="page" v-html="page.content"></div>
</template>

<script>
    export default {
        data() {
            return {
                page: []
            }
        },
        mounted() {
            let pageSlug = this.$route.params.slug;
            this.$api.get('page').get(pageSlug).then(response => {
                this.page = response.data
            }).then(response => this.$emit('loaded'));
        }
    }
</script>



<style scoped>
    @import "@/assets/style/variables.scss";

    .page {
        padding: 20px 30px;
        color: var(--text-color);

        font-size: $contentFontSize;
        line-height: $contentLineHeight;
    }
</style>
