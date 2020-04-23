'use strict';

const Swal = require('sweetalert2')
const ajax = require('@js/ajax')
var Routing = require('@js/JSRouting');
import sortable from '@js/sortable.js';

// Makte table sortable
var table = document.querySelector('table tbody');
sortable(table, {
    onEnd(e) {
        ajax.post({
            url: Routing.generate('_posts_sort', {post: e.item.dataset.post}),
            data: {
                order: e.newIndex
            },
            success: function() {
                toastr.success('Post sorted successfully');
            },
            error: function() {
                toastr.error('Error sorting post');
            }
        });
    }
});

