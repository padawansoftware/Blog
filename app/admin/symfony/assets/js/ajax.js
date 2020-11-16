'use strict';

const $ = require('jquery');

module.exports = {
    delete(deleteUrl, successFunction, errorFunction) {
        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            success: successFunction,
            error: errorFunction
        });
    },
    post({url, data, success, error}) {
        $.ajax({
            url,
            data,
            method: 'POST',
            success,
            error
        });
    }
};
