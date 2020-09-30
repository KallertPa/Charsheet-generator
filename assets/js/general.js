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
     * For the contenteditable
     * should be editable with right click since left click activates the drag and drop 
     */
    $(document).on("contextmenu", '*[contenteditable="true"]', function (e) {
        e.preventDefault();
        return false;
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



    /**
     * Toggling the views in the sidebar
     */

    $('.area_toggle').on('click', function (e) {
        e.preventDefault();
        var ele = $(this).attr('data-toggle');
        $('.' + ele).toggle(300, function () {
            // Animation complete.
        });
        $(this).toggleClass('hide_icon');
    });
});