<template>
    <router-link class="card" :to="to">
        <img :src="this.image">
        <div class="title-cover">
            <span class="title">{{ title }}</span>
            <span class="subtitle"><slot name="subtitle"></slot></span>
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
        ]
    }
</script>

<style scoped>
    .card {
        position: relative;
        padding-top: 50%;
        overflow: hidden;

        & > * {
            position: absolute;
        }

        img {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 50%;

            background-color: #000;
            transition: all 0.3s ease-in;
        }

        &:hover img {
            transform: scale(1.1);
        };

        .title-cover {
            position: absolute;
            bottom: 0;

            height: 60px;
            width: 100%;
            padding: 10px;

            background: #000B;
            font-family: "Star Wars";
            text-transform: lowercase;
            line-height: 18px;

            .title {
                font-size: 16px;
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
</style>
