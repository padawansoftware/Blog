<template>
    <div class="card">
        <router-link :to="to">
            <div
                class="content"
                :style="style"
            >
                <div class="title-cover">
                    <span class="title">{{ title }}</span>
                    <slot></slot>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'card',
        props: [
            'to',
            'title',
            'image',
        ],
        computed: {
            style: function() {
                return `
                    background-image: url('${this.image}');
                `
            }
        },
    }
</script>

<style scoped>
    .card {
        .content {
            position: relative;

            height: 100%;

            border-radius: 5px;
            background-size: cover;

            .title-cover {
                position: absolute;
                bottom: 0px;

                width: 100%;
                padding: 10px 0 10px 100px;

                background: #0008;
                font-family: "Star Wars";
                text-transform: lowercase;

                .title {
                    font-size: 18px;
                }
            }
        }
    }
</style>
