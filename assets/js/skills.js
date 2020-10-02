/**
 * Automatic calculation
 */
window.automatic_calculation = false;

function ChangeAutoCalc(new_calc) {
    window.automatic_calculation = new_calc;
    //if the calculation is active
    if(new_calc){
        $('.show_on_hover').removeClass('not_active'); 
        $('.show-overflow').removeClass('not_active'); 
    } else {
        $('.show_on_hover').addClass('not_active'); 
        $('.show-overflow').addClass('not_active'); 
    }
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

    var extra_calcs = getAttributeChanges(); 
    console.log(extra_calcs);
    //get all the current attributes 
    $('.attrib_edit').each(function () {
        var skill = $(this).attr('data-attr');
        var text = $(this).text();
        attribs[skill] = text;

        extra_calcs.forEach(function(calc){
            calc = calc.replace('gei', 'sk').replace(skill, '0');
            try{
                let result = eval(calc); 
                if (typeof (result) == "number") {
                    attribs[skill]  = result + parseInt(attribs[skill]); 
                }
            } catch (e) {}
        }); 

        //when all the attributes have been looped through 
        if (attribs.length = 9) {
            console.log(attribs); 
            // get the Equipment value 
            attribs['pa'] = parseInt($('.dungeonslayer-content .pa_result').text());
            if (Number.isNaN(attribs['pa'])) {
                attribs['pa'] = "0";
            }
            $('.dungeonslayer-content .skill_item').each(function () {
                //workaround for problem with geist und geschick: usually first replaces the ge and then the gei is not replaced. Now rename gei to sk
                var value = $(this).children('.item_text').text().toLowerCase().replace('ä', 'a').replace('ö', 'o').replace('gei', 'sk');
                var skill_name = $(this).children('.item_title').text().toLowerCase(); 
                var new_v = value;
                for (key in attribs) {
                    if (value.indexOf(key) >= 0) {
                        if (attribs[key]) {
                            new_v = new_v.replace(key, attribs[key]);
                        }
                    }
                };
                var extra_value = 0; 

                extra_calcs.forEach(function(calc){
                    calc = calc.replace(skill_name, '0');
                    try{
                        let result = eval(calc); 
                        if (typeof (result) == "number") {
                            extra_value = result + extra_value; 
                        }
                    } catch (e) {}
                }); 
                try {
                    old_v = new_v;
                    //for the perception: replace the 8 
                    new_v = new_v.replace('oder 8', '');
                    var res = eval(new_v);

                    if (typeof (res) == "number" && res > 0) {

                        if (old_v.indexOf('oder 8') >= 0 && res < 8) {
                            res = 8;
                        }
                        res = extra_value + res; 
                        $(this).children('.skill_edit').text(res);
                    }
                } catch (e) {}

            });
        }
    });
}

function getAttributeChanges(){
    var extra_calcs = [];
    $('.dungeonslayer-content .custom_calc').each(function(){
        var text = $(this).text().toLowerCase().replace(' ', '');
        if(text){
            extra_calcs.push(text); 
        } 
    }); 
    return extra_calcs; 
}

$(document).ready(function () {

    //default: do not show autocalc field s
    $('.show_on_hover').addClass('not_active'); 
    $('.show-overflow').addClass('not_active'); 
    $('#auto_calc').on('change', function (e) {

        if($(this).is(':checked')){
            var new_calc = true; 
        } else {
            var new_calc = false; 
        }
        
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
    $(document).on('input', '.dungeonslayer-content .custom_calc', function () {
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