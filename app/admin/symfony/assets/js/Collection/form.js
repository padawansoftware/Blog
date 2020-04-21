// Load image uploader plugin
require('@js/imageUploader.js')

// Utils
var utils = require('@js/utils.js');

// Create slug from titles
$('#slug-button').click(function(){
    var title = $('#collection_name').val();
    $('#collection_slug').val(utils.slugify(title));
});
