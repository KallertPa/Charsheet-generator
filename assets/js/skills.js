/**
 * Automatic calculation
 */
window.automatic_calculation = false;

function ChangeAutoCalc(new_calc) {
    window.automatic_calculation = new_calc;
}

function calculatePA() {
    var total = 0;
    $('.dungeonslayer-content .pa_edit').each(function () {
        var text = parseInt($(this).text());
        if (typeof (text) == "number" && text > 0) {
            total += text;
        }
    });
    if (total > 0) {
        $('.dungeonslayer-content .pa_result').text(total);
    }
}
function calculateSkills() {
    var attribs = [];

    //get all the current attributes 
    $('.attrib_edit').each(function () {
        var skill = $(this).attr('data-attr');
        var text = $(this).text();
        attribs[skill] = text;

        //when all the attributes have been looped through 
        if (attribs.length = 9) {

            // get the Equipment value 
            attribs['pa'] = parseInt($('.dungeonslayer-content .pa_result').text());
            if (Number.isNaN(attribs['pa'])) {
                attribs['pa'] = "0";

            }
            $('.dungeonslayer-content .skill_item').each(function () {
                //workaround for problem with geist und geschick: usually first replaces the ge and then the gei is not replaced. Now rename gei to sk
                var value = $(this).children('.item_text').text().toLowerCase().replace('ä', 'a').replace('ö', 'o').replace('gei', 'sk');
                var new_v = value;
                for (key in attribs) {
                    if (value.indexOf(key) >= 0) {
                        if (attribs[key]) {
                            new_v = new_v.replace(key, attribs[key]);
                        }
                    }
                };
                try {
                    old_v = new_v;
                    //for the perception: replace the 8 
                    new_v = new_v.replace('oder 8', '');
                    var res = eval(new_v);
                    if (typeof (res) == "number" && res > 0) {

                        if (old_v.indexOf('oder 8') >= 0 && res < 8) {
                            res = 8;
                        }
                        $(this).children('.skill_edit').text(res);
                    }
                } catch (e) {}

            });
        }
    });
}

$(document).ready(function () {
    $('#auto_calc').on('change', function (e) {
        var new_calc = !window.automatic_calculation;
        ChangeAutoCalc(new_calc);
        if (window.automatic_calculation) {
            calculatePA();
            calculateSkills();
        }
    });

    /**
     * On Attributes edit calculate the Skills 
     */
    $(document).on('input', '.dungeonslayer-content .attrib_edit', function () {
        if (window.automatic_calculation) {
            calculateSkills();
        }
    });

    $(document).on('input', '.dungeonslayer-content .nsc_attrib_edit', function () {
        var attribs = [];

        //get all the current attributes 
        $(this).closest('.dungeonslayer-content').find('.nsc_attrib_edit').each(function () {
            var skill = $(this).attr('data-attr');
            var text = $(this).text();
            attribs[skill] = text;

            //when all the attributes have been looped through 
            if (attribs.length = 11) {
                $(this).closest('.dungeonslayer-content').find('.nsc_skill').each(function () {
                    //workaround for problem with geist und geschick: usually first replaces the ge and then the gei is not replaced. Now rename gei to sk
                    var value = $(this).children('.skill_edit').attr('data-calc');
                    var new_v = value;
                    for (key in attribs) {
                        if (value.indexOf(key) >= 0) {
                            if (attribs[key]) {
                                new_v = new_v.replace(key, attribs[key]);
                            }
                        }
                    };
                    try {
                        old_v = new_v;
                        var res = eval(new_v);

                        if (typeof (res) == "number" && res > 0) {

                            $(this).children('.skill_edit').text(res);
                        }
                    } catch (e) {}

                });
            }
        });
    });


    /** 
     * On edit the Equipment table, calculate total equipment stats  
     */
    $(document).on('input', '.dungeonslayer-content .pa_edit', function () {
        if (window.automatic_calculation) {
            calculatePA();
            calculateSkills();
        }
    });

    
});