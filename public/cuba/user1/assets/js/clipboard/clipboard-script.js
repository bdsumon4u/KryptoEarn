(function($) {
    "use strict";
    var clipboard = new ClipboardJS('.btn-clipboard');
    clipboard.on('success', function(e) {

        $.notify({

                message:'Copied successfully'
            },
            {
                type:'success',
                allow_dismiss:false,
                newest_on_top:true ,
                mouse_over:true,
                showProgressbar:false,
                spacing:10,
                timer:2000,
                placement:{
                    from:'top',
                    align:'right'
                },
                offset:{
                    x:30,
                    y:30
                },
                delay:1000 ,
                z_index:10000,
                animate:{
                    enter:'animated bounce',
                    exit:'animated bounce'
                }
            });





    });
    clipboard.on('error', function(e) {

    });

    var clipboard = new ClipboardJS('.btn-clipboard-cut');
    clipboard.on('success', function(e) {
        // alert("cut");
        // e.clearSelection();
    });
    clipboard.on('error', function(e) {

    });
})(jQuery);
