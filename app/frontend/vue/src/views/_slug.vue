<template>
    <div class="content-wrapper">
        <div class="page" v-html="page.content">
        </div>
    </div>
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
            });
        }
    }
</script>



<style scoped>
    .page {
        position: relative;

        margin-bottom: 50px;
        border: 1px solid var(--primary-color);

        border-radius: 5px;
        padding: 0 15%;
        background: black;
        color: var(--text-color);

        [data-theme="aliance"] & {
            background: none;
            --text-color: black;
        }
    }
</style>
