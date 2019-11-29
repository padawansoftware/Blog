<!--
    Post detailed content
-->
<template>
    <div class="post">
        <slot name="title">
            <h1>{{ post.title }}</h1>
        </slot>
        <div class="chapters">
            <div class="chapter"
                v-for="chapter in post.chapters"
            >
                <a :href="chapter.title|hash" :id="chapter.title|slugify">
                    <h2 v-if="post.chapters.length > 1">{{ chapter.title }}</h2>
                </a>
                <div v-html="chapter.content"></div>
            </div>
        </div>

        <slot name="footer"></slot>
    </div>
</template>

<script>
    // Import prism theme
    const Prism = require('prismjs/prism.js');
    require('prismjs/themes/prism-tomorrow.css');
    require('prismjs/plugins/line-highlight/prism-line-highlight.js');
    require('prismjs/plugins/line-highlight/prism-line-highlight.css');
    require('prismjs/components/prism-markup-templating.min.js');
    require('prismjs/components/prism-php.js');

    const Spoiler = require('@padawansoftware/spoiler.js');
    require('@padawansoftware/spoiler.js/src/spoiler.css');

    function slugify(string) {
        const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
        const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
        const p = new RegExp(a.split('').join('|'), 'g')

        return string.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
            .replace(/&/g, '-and-') // Replace & with 'and'
            .replace(/[^\w\-]+/g, '') // Remove all non-word characters
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, '') // Trim - from end of text
    }

    export default {
        name: 'post',
        props: [
            'post'
        ],
        updated() {
            Prism.highlightAll();
            Spoiler.initAll();
        },
        filters: {
            hash: function(string) {
                return '#' + slugify(string);
            },
            slugify: function(string) {
                return slugify(string);
            }
        }
    }
</script>

<style scoped>
    h1 {
        text-align: center;
        font-size: 40px;
        font-family: "Star Wars";
        text-transform: lowercase;
        color: var(--yellow);
    }

    .post {
        position: relative;

        margin-bottom: 50px;
        border: 1px solid var(--yellow);
        border-radius: 5px;
        padding: 0 15%;

        background: black;

        .chapters {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;

            color: white;

            .chapter {
                width: 100%;

                &:not(:last-child) {
                    margin-bottom: 40px;
                }
            }
        }
    }
</style>

<style>
    .post .chapter {
        a {
            font-weight: bold;
        }

        img {
            max-width:100%;
        }

        pre {
            margin: 0px auto;
            white-space: pre-wrap;
            font-size: 15px;

            code {
                white-space: inherit;
            }
        }

        hr {
            display: none;
        }
    }
</style>
