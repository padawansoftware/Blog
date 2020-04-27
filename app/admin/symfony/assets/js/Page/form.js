'use strict';

// Utils
var utils = require('../utils.js');

// Import routing
var Routing = require('../JSRouting.js');

// Trumowyg plugin function
var trumbowyg = require('../trumbowyg.js');
var trumbowygParams = {
    serverPath: Routing.generate('_page_upload_image', {'page': $('.page').data('page')})
}

trumbowyg(trumbowygParams);

// Create slug from name
$('#slug-button').click(function(){
    var name = $('#page_name').val();
    $('#page_slug').val(utils.slugify(name));
});

