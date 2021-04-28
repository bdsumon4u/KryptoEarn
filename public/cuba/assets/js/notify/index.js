'use strict';
var message, type, notify;
if (message = $('#success-flash').data('message')) {
    type = 'success';
} else if (message = $('#danger-flash').data('message')) {
    type = 'danger';
}

if(type) notify = $.notify('<i class="fa fa-bell-o"></i><strong>'+ message +'</strong>', {
    type: type,
    allow_dismiss: true,
    delay: 5000,
    showProgressbar: true,
    timer: 5000,
    animate:{
        enter:'animated fadeInDown',
        exit:'animated fadeOutUp'
    }
});

// setTimeout(function() {
//     notify.update('message', '<i class="fa fa-bell-o"></i><strong>Loading</strong> Inner Data.');
// }, 1000);
