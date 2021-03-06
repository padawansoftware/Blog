'use strict';

// Style
require('@css/Post/form.scss');

const $ = require('jquery');

// Utils
var utils = require('@js/utils.js');

// Chosen JS
require('chosen-js');
require('chosen-js/chosen.min.css');

// Import routing
var Routing = require('@js/JSRouting.js');

// Trumowyg plugin function
var trumbowyg = require('@js/trumbowyg.js');
var trumbowygParams = {
    serverPath: Routing.generate('_posts_upload_chapter_image', {'post': $('.post').data('post')})
}

// Load image uploader plugin
require('@js/imageUploader.js')

// Add new chapter
$('#chapter_actions #blog-add-chapter').on('click', function() {
    addChapter($("#chapters .chapter").length);
});

// Select a chapter
$('#chapter_actions').on('click', '.chapter', function() {
    selectChapter(this.dataset.chapter);
});

// Remove a chapter
$('#chapter_actions #blog-remove-chapter').on('click', function(event) {
    event.preventDefault();

    $('#chapter_selector .chapter').last().remove();
    $('#chapters .chapter').last().remove();
})

function addChapter(id)
{
    var chapterSelector = `<button class="ps chapter" data-chapter="${id}" title="">${id}</button>`;
    var chapter = `
        <div class="chapter" data-chapter="${id}">
            <div class="group">
                <label for="post_chapters_${id}_title" class="required">Title</label>
                <input type="text" id="post_chapters_${id}_title" name="post[chapters][${id}][title]" required="required">
            </div>
            <div class="group">
                <label for="post_chapters_${id}_content" class="required">Content</label>
                <textarea id="post_chapters_${id}_content" class="wysiwyg" name="post[chapters][${id}][content]" required="required"></textarea>
            </div>
            <div class="group">
                <input type="checkbox" id="post_chapters_${id}_enabled" name="post[chapters][${id}][enabled]">
                <label for="post_chapters_${id}_enabled">Enabled</label>
            </div>
        </div>
    `;

    $('#chapter_selector').append(chapterSelector);
    $('#chapters').append(chapter);

    trumbowyg(trumbowygParams);

    selectChapter(id);
}

function selectChapter(id)
{
    $('.chapter').removeClass('active');
    $(`.chapter[data-chapter=${id}]`).toggleClass('active');
}

// Initialize trymbowyg in wysiwyg elements
trumbowyg(trumbowygParams);

// Initialize chosen plugin
$("select").chosen();

// Create slug from titles
$('#slug-button').click(function(){
    var title = $('#post_title').val();
    $('#post_slug').val(utils.slugify(title));
});

a
