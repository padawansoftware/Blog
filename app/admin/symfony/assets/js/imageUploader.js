'use strict';

const $ = require('jquery');

$('.image-upload img').click(() => {
    $('.image-upload input').click();
});

$('.image-upload input').on('change', function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.image-upload img').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
});
