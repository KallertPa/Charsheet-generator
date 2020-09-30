$(document).ready(function () {
    /**
     * Change font stuff
     */

    $('#fonts').on('change', function () {
        var selected = $("#fonts :selected").val();
        $("body").removeClass();
        $('body').addClass(selected);
    });

    $('#change_font').click(function (e) {
        e.preventDefault();
        var selected = $("#font_selection :selected").val();
        var tr = window.getSelection().getRangeAt(0);
        var span = document.createElement("span");
        span.classList.add(selected);
        tr.surroundContents(span);

    });
    const pickr = new Pickr({
        el: '.pickr-container',
        theme: 'classic',
        default: '#42445a',
        lockOpacity: true,
        components: {
            palette: true,
            preview: true,
            opacity: false,
            hue: true,
            interaction: {
                hex: false,
                rgba: false,
                hsla: false,
                hsva: false,
                cmyk: false,
                input: true,
                cancel: false,
                clear: false,
                save: true,
            }
        }
    });
    pickr.on('save', (color, instance) => {
        pickr.hide();
    });

    $('#change_color').click(function (e) {
        e.preventDefault();
        var tr = window.getSelection().getRangeAt(0);
        var span = document.createElement("span");
        var color = pickr.getColor();
        span.style.cssText = "color:" + color.toHEXA();
        tr.surroundContents(span);

    });
});