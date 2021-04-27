'use strict';
var message = $('#success-flash').data('message');
if (message) {
    var notify = $.notify('<i class="fa fa-bell-o"></i><strong>'+ message +'</strong>', {
        type: 'theme',
        allow_dismiss: true,
        delay: 2000,
        showProgressbar: true,
        timer: 300,
        animate:{
            enter:'animated fadeInDown',
            exit:'animated fadeOutUp'
        }
    });
}

// setTimeout(function() {
//     notify.update('message', '<i class="fa fa-bell-o"></i><strong>Loading</strong> Inner Data.');
// }, 1000);
