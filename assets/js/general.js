$(document).ready(function () {


    //enable bootstrap tooltips 
    $('[data-toggle="tooltip"]').tooltip()

    /**
     * Changing the Skill in the edit sidebar 
     * after clicking confirm in the popup
     */
    $('#change_image').click(function (e) {
        e.preventDefault();

        var title = $('#new_item_title').val();
        var text = $('#new_item_text').val();
        var radioValue = $("input[name='icon']:checked").val();
        $('.top-items-edit .item_title').html(title);
        $('.top-items-edit .item_text').html(text);
        if (radioValue) {
            $('.top-items-edit .item_image').html('<img src="./assets/img/icons/' + radioValue + '" />');
        }
        close_dialog();
    });


    /**
     * Sticky Sidebar 
     **/
    if (($(document).scrollTop() > 275)) {
        $('.top-items-edit').removeClass('relative');
        $('.top-items-edit').addClass('fixed');
    } else {
        $('.top-items-edit').removeClass('fixed');
        $('.top-items-edit').addClass('relative');
    }

    $(window).scroll(function () {
        if (($(document).scrollTop() > 275)) {
            $('.top-items-edit').removeClass('relative');
            $('.top-items-edit').addClass('fixed');
        } else {
            $('.top-items-edit').removeClass('fixed');
            $('.top-items-edit').addClass('relative');
        }
    });


    //onload get the status of the toggled stuff in sidebar and set 
    $('.area_toggle').each(function(){
        var ele = $(this).attr('data-toggle');
        if (typeof localStorage !== 'undefined') {
            if(localStorage.hasOwnProperty("toggle_"+ele)){
                if(localStorage.getItem('toggle_'+ele)){
                    $('div[data-toggle="'+ele+'"]').addClass('hide_icon'); 
                    $('.' + ele).hide(); 
                } else {
                    $('div[data-toggle="'+ele+'"]').removeClass('hide_icon'); 
                    $('.' + ele).show(); 
                }

            }
        }
    }); 
    /**
     * Toggling the views in the sidebar
     */

    $('.area_toggle').on('click', function (e) {
        e.preventDefault();
        var ele = $(this).attr('data-toggle');
        $('.' + ele).toggle(300, function () {});
        $(this).toggleClass('hide_icon');
        if (typeof localStorage !== 'undefined') {
            localStorage.setItem("toggle_"+ele, $( this ).hasClass( "hide_icon" ));
        }
    });
});