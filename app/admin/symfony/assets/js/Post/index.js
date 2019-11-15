'use strict';

const Swal = require('sweetalert2')
const ajax = require('../ajax')
var Routing = require('../JSRouting');
import sortable from '../sortable.js';

$('.js-delete-element').click(function(event){
    event.preventDefault();

    // Extract delete url
    var deleteUrl = this.href;

    Swal.fire({
        title: 'Are you sure?',
        text: "You are deleting an element!",
        type: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            // Make delete
            ajax.delete(deleteUrl, response => {
                Swal.fire(
                  'Deleted!',
                  'Your element has been deleted.',
                  'success'
                ).then(result =>  location.reload() )
            })
        }
    })
});

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

