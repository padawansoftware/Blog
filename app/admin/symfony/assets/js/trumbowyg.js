'use strict';

const $ = require('jquery');

//  Trumbowyg
require('trumbowyg/dist/ui/trumbowyg.min.css');
require('trumbowyg/dist/trumbowyg.min.js');

// Include icons
var icons = require("trumbowyg/dist/ui/icons.svg");
$.trumbowyg.svgPath = icons;

// Upload plugin
require('trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js');

// Emoji plugin
require('trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css');
require('trumbowyg/dist/plugins/emoji/trumbowyg.emoji.js');

// Highlight plugin
require('prismjs/themes/prism-tomorrow.css');
require('prismjs/prism.js');
require('prismjs/components/prism-markup-templating.min.js');
require('prismjs/components/prism-php.js');
require('prismjs/plugins/line-numbers/prism-line-numbers.css');
require('prismjs/plugins/line-numbers/prism-line-numbers.min.js');
require('prismjs/plugins/line-highlight/prism-line-highlight.css');
require('prismjs/plugins/line-highlight/prism-line-highlight.min.js');
require('trumbowyg/dist/plugins/highlight/ui/trumbowyg.highlight.css');
require('trumbowyg/dist/plugins/highlight/trumbowyg.highlight.min.js');

// Spoiler plugin
const Spoiler = require('@padawansoftware/spoiler.js');
require('@padawansoftware/spoiler.js/src/spoiler.css');
require('@padawansoftware/trumbowyg-spoiler-plugin');
require('@padawansoftware/trumbowyg-spoiler-plugin/ui/sass/trumbowyg.spoiler.css');

// EasyHTML plugin
require('@padawansoftware/trumbowyg-easyhtml-plugin');
require('@padawansoftware/trumbowyg-easyhtml-plugin/ui/sass/trumbowyg.easyhtml.css');

// Color plugin
require('trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js');
require('trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css');

// Trumowyg plugin parameters
var defaultParams = {
    semantic: {
        'div': 'div'
    },
    defaultLinkTarget: '_blank',
    // Create a new dropdown
    btnsDef: {
        image: {
            dropdown: ['insertImage', 'upload'],
            ico: 'insertImage'
        },
    },
    // Redefine the button pane
    btns: [
        ['viewHTML'],
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['foreColor', 'backColor'],
        ['link'],
        ['image'], // Our fresh created dropdown
        ['emoji'],
        ['highlight'],
        ['spoiler'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        ['upload'],
        ['easyHTML']
    ],
    plugins: {
        upload: {
            serverPath: '', // To be defined
            fileFieldName: 'asset[file][file]',
            urlPropertyName: 'link',
            success: successCallback
        },
        easyHTML: {
            templates: {
                my_anchor: {
                    text: 'Code tag',
                    values: {
                        tag: 'code',
                        class: 'code-tag',
                    }
                },
            }
        }
    }
}

/* Start copy from trumbowyg upload plugin */
function getDeep(object, propertyParts) {
    var mainProperty = propertyParts.shift(),
        otherProperties = propertyParts;

    if (object !== null) {
        if (otherProperties.length === 0) {
            return object[mainProperty];
        }

        if (typeof object === 'object') {
            return getDeep(object[mainProperty], otherProperties);
        }
    }
    return object;
}

function insertImage(data, trumbowyg, $modal, values) {
    if (!!getDeep(data, trumbowyg.o.plugins.upload.statusPropertyName.split('.'))) {
        var url = getDeep(data, trumbowyg.o.plugins.upload.urlPropertyName.split('.'));
        trumbowyg.execCmd('insertImage', url, false, true);
        var $img = $('img[src="' + url + '"]:not([alt])', trumbowyg.$box);
        $img.attr('alt', values.alt);
        if (trumbowyg.o.imageWidthModalEdit && parseInt(values.width) > 0) {
            $img.attr({
                width: values.width
            });
        }
        setTimeout(function () {
            trumbowyg.closeModal();
        }, 250);
        trumbowyg.$c.trigger('tbwuploadsuccess', [trumbowyg, data, url]);
    } else {
        trumbowyg.addErrorOnModalField(
            $('input[type=file]', $modal),
            trumbowyg.lang[data.message]
        );
        trumbowyg.$c.trigger('tbwuploaderror', [trumbowyg, data]);
    }
}
/* End copy from trumbowyg upload plugin*/

function insertFormatIcon(data, trumbowyg, $modal, values) {
    trumbowyg.restoreRange();
    trumbowyg.execCmd('insertHTML', `<a href="${data.link}" target="_blank"><span class="fa fa-file-${data.format}-o"></span></a>`);
    trumbowyg.closeModal();
}

function successCallback(data, trumbowyg, $modal, values) {
    if (['jpg', 'jpeg', 'png', 'svg'].includes(data.format)) {
        insertImage(data, trumbowyg, $modal, values);
    } else {
        insertFormatIcon(data, trumbowyg, $modal, values);
    }
}

module.exports = function(params) {
    var trumbowygParams = Object.assign({}, defaultParams);
    trumbowygParams.plugins.upload.serverPath = params.serverPath;

    $(".wysiwyg").trumbowyg(trumbowygParams);

    // Init spoilers
    Spoiler.initAll();
}
