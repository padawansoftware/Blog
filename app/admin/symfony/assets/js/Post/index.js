'use strict';

const Swal = require('sweetalert2')
const ajax = require('../ajax')

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