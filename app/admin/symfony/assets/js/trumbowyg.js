'use strict';

//  Load trumbowyg
require('trumbowyg/dist/ui/trumbowyg.min.css');
require('trumbowyg/dist/trumbowyg.min.js');

//  Load upload plugin
require('trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js');

// Load emoji plugin
require('trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css');
require('trumbowyg/dist/plugins/emoji/trumbowyg.emoji.js');

//  Load highlight
require('prismjs/themes/prism-tomorrow.css');
require('prismjs/prism.js');
require('prismjs/components/prism-markup-templating.min.js');
require('prismjs/components/prism-php.js');
require('prismjs/plugins/line-highlight/prism-line-highlight.css');
require('prismjs/plugins/line-highlight/prism-line-highlight.min.js');
require('trumbowyg/dist/plugins/highlight/ui/trumbowyg.highlight.css');
require('trumbowyg/dist/plugins/highlight/trumbowyg.highlight.min.js');

// Load spoiler
const Spoiler = require('@padawansoftware/spoiler.js');
require('@padawansoftware/spoiler.js/src/spoiler.css');
require('@padawansoftware/trumbowyg-spoiler-plugin');
require('@padawansoftware/trumbowyg-spoiler-plugin/ui/sass/trumbowyg.spoiler.css');

// Include icons
var icons = require("trumbowyg/dist/ui/icons.svg");
$.trumbowyg.svgPath = icons;

// Trumowyg plugin parameters
var defaultParams = {
    semantic: {
        'div': 'div'
    },
    // Create a new dropdown
    btnsDef: {
        image: {
            dropdown: ['insertImage', 'upload'],
            ico: 'insertImage'
        }
    },
    // Redefine the button pane
    btns: [
        ['viewHTML'],
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['image'], // Our fresh created dropdown
        ['emoji'],
        ['highlight'],
        ['spoiler'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],
    plugins: {
        upload: {
            serverPath: '', // To be defined
            fileFieldName: 'asset[file][file]',
            urlPropertyName: 'link'
        }
    }
}

module.exports = function(params) {
    var trumbowygParams = Object.assign({}, defaultParams);
    trumbowygParams.plugins.upload.serverPath = params.serverPath;

    $(".wysiwyg").trumbowyg(trumbowygParams);

    // Init spoilers
    Spoiler.initAll();
}
