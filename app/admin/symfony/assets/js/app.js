'use strict';

require('../css/theme.scss');
window.$ = require('jquery');

const Swal = require('sweetalert2')
const ajax = require('./ajax')

window.toastr = require('toastr');
require('toastr/build/toastr.min.css');

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
    })
    .then((result) => {
        if (result.value) {
            // Make delete
            ajax.delete(
                deleteUrl,
                () => {
                    Swal.fire(
                      'Deleted!',
                      'Your element has been deleted.',
                      'success'
                    ).then(result =>  location.reload() )
                },
                () => {
                    Swal.fire(
                      'Error!',
                      'An error occurred deleting the element.',
                      'error'
                    )
                }
            )
        }
    })
});

$('.js-toggle-element-status').click(function(event){
    event.preventDefault();

    // Toggle status button
    var toggleStatusButton = $(this);

    // Toggle status url
    var toggleStatusUrl = this.href ? this.href : this.dataset.href;

    ajax.post({
        url: toggleStatusUrl,
        data: {'post': toggleStatusButton.parents('.post').data('post')},
        success(response) {
            toggleStatusButton.text(toggleStatusButton.text() == 'Enabled' ? 'Disabled' : 'Enabled');
            toggleStatusButton.toggleClass('enabled disabled');
        },
        error(response) {}
    });
});

