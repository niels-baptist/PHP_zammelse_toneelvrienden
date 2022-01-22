require('./bootstrap');

$(function(){

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    }).on('click', '[data-toggle="tooltip"]', function () {
        // hide tooltip when you click on it
        $(this).tooltip('hide');
    });

    // stop playing help-video when modal closes
    $('.modal').on('hidden.bs.modal', function () {
        $('iframe').each(function () {
            $(this).attr('src', $(this).attr('src'));
        })
    });

});
