$(document).ready(function () {
    /**
     * Popup Window functions 
     */
    $('.open_dialog').on('click', function (e) {
        e.preventDefault();
        var name = $(this).attr('data-dialog');
        console.log(name);
        $('.dialog').hide();
        $('#dialog').show();
        $('.dialog_' + name).fadeIn();
        $('#black_overlay').fadeIn();

        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });

    $('.close_dialog').click(function (e) {
        e.preventDefault();
        close_dialog();
    });



    $('.scroll_to').click(function (e) {
        e.preventDefault();
        var ele = $(this).attr('href');
        console.log(ele);
        $("html, body").animate({
            scrollTop: $(ele).offset().top
        }, 300);
    });

    //when scrolling, hide all alerts 
    $(window).scroll(function(){ 
         $('.alert').fadeOut(300); 
    }); 

    $('.close').click(function(e){
        e.preventDefault();    
        $('.alert').fadeOut(300); 
    }); 
});

function close_dialog() {
    $('#dialog').fadeOut();
    $('#black_overlay').fadeOut(300);
}
function show_error(text){
    $('.alert').hide(); 
    $('.alert-danger > span').text(text)
    $('.alert-danger').fadeIn(300);
}

function show_success(text){
    $('.alert').hide(); 
    $('.alert-success > span').text(text)
    $('.alert-success').fadeIn(300);
}
function show_message(text){
    $('.alert').hide(); 
    $('.alert-warning > span').text(text)
    $('.alert-warning').fadeIn(300);
}

function close_alerts(){
    $('.alert').fadeOut(300); 
}