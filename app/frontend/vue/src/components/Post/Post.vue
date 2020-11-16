<!--
    Post detailed content
-->
<template>
    <div class="post">
        <slot name="title">
            <h1 class="title">{{ post.title }}</h1>
        </slot>
        <div class="chapters line-numbers">
            <!-- Chapter -->
            <div class="chapter"
                v-for="chapter in post.chapters"
            >
                <!-- Chapter title-->
                <h2 v-if="post.chapters.length > 1" id="chapter.title|slugify">{{ chapter.title }}</h2>

                <!-- Chapter content -->
                <div class="content" v-html="chapter.content"></div>
            </div>
        </div>

        <slot name="footer"></slot>
    </div>
</template>

<script>
    // Import prism theme
    const Prism = require('prismjs/prism.js');
    require('prismjs/themes/prism-tomorrow.css');
    require('prismjs/components/prism-markup-templating.min.js');
    require('prismjs/components/prism-php.js');
    require('prismjs/plugins/line-numbers/prism-line-numbers.css');
    require('prismjs/plugins/line-numbers/prism-line-numbers.min.js');
    require('prismjs/plugins/line-highlight/prism-line-highlight.js');
    require('prismjs/plugins/line-highlight/prism-line-highlight.css');
    require('prismjs/plugins/toolbar/prism-toolbar.min.js');
    require('prismjs/plugins/toolbar/prism-toolbar.css');
    require('prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js');

    const Spoiler = require('@padawansoftware/spoiler.js');
    require('@padawansoftware/spoiler.js/src/spoiler.css');

    const MediumZoom = require('medium-zoom').default;
    const mediumZoomConfig = {
        background: '#4f4f4f9c'
    }

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

    // Throws resize event in window in order to draw lines on spoiler toggle
    function addResizeEvent() {
        document.querySelectorAll('.spoiler').forEach(function(node, index, nodeList) {
            node.addEventListener('click', function() {
                window.dispatchEvent(new Event('resize'));
            })
        });
    }


    export default {
        name: 'post',
        props: [
            'post'
        ],
        updated() {
            Spoiler.initAll();
            Prism.highlightAll();
            addResizeEvent();
            MediumZoom('.post img', mediumZoomConfig);
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
    @import "@/assets/style/variables.scss";

    .post {
        background-color: var(--second-background);
        padding: 20px 30px;

        [data-theme="aliance"] & {
            background: none;
            --text-color: black;
        }

        .title {
            text-align: center;
            font-size: 40px;
            font-family: "Star Wars";
            text-transform: lowercase;
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 50px;
        }

        .chapters {
            display: flex;

            justify-content: center;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;

            font-size: $contentFontSize;
            color: var(--text-color);
            line-height: $contentLineHeight;

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
        h2{
            color: var(--primary-color);
        }

        a {
            font-weight: bold;
        }

        img {
            max-width:100%;
            max-height: 30vh;
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
