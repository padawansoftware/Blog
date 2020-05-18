<template>
        <router-link class="card" :to="to">
            <div
                class="content"
                :style="style"
            >
                <div class="title-cover">
                    <span class="title">{{ title }}</span>
                    <span class="subtitle"><slot name="subtitle"></slot></span>
                </div>
            </div>
        </router-link>
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
            background-color: var(--primary-color);

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

                .subtitle {
                    display: block;

                    margin-top: 5px;

                    font-family: Rokkitt, serif;
                    font-size: 14px;
                    color: white;
                }
            }
        }
    }
</style>
