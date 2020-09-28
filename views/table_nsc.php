<?php
/**
 * NSC Table
 */
?>

<div id="table" class="table-editable nsc_table">
    <table class="table table-bordered table-responsive-md text-left">
        <thead>
            <tr>
                <th class="text-center" contenteditable="true" colspan="3">NSC-Begleiter</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">KÖR:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="kor"></div>       
                </td>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">AGI:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="agi"></div>       
                </td>
                <td class="p-0 clearfix">
                    <div class="half_table half_first text-right woodstamp">GEI:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="gei"></div>       
                </td>
            </tr>
            
            <tr>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">ST:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="st"></div>       
                </td>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">BE:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="be"></div>       
                </td>
                <td class="p-0 clearfix">
                    <div class="half_table half_first text-right woodstamp">VE:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="ve"></div>       
                </td>
            </tr>
            <tr>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">HÄ:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="ha"></div>       
                </td>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">GE:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="sk"></div>       
                </td>
                <td class="p-0 clearfix">
                    <div class="half_table half_first text-right woodstamp">AU:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="au"></div>       
                </td>
            </tr>
            <tr>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp">PA:</div> 
                    <div class="half_table nsc_attrib_edit" contenteditable="true" data-attr="pa"></div>       
                </td>
                <td class="p-0 clearfix" style="width: 33%;">
                    <div class="half_table half_first text-right woodstamp"></div> 
                    <div class="half_table " contenteditable="true"></div>       
                </td>
                <td class="p-0 clearfix">
                    <div class="half_table half_first text-right woodstamp"></div> 
                    <div class="half_table " contenteditable="true"></div>       
                </td>
            </tr>
            <tr>
                <td class="p-0 clearfix " colspan="3">
                    <div class="d-flex">
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="kor+ha+10"></div>
                            <div class="item_image"><img src="/assets/img/icons/hit-points.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="kor+ha+pa"></div>
                            <div class="item_image"><img src="/assets/img/icons/defense.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="agi+be"></div>
                            <div class="item_image"><img src="/assets/img/icons/initiative.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="(agi/2)+1"></div>
                            <div class="item_image"><img src="/assets/img/icons/movement-rate.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="kor+st"></div>
                            <div class="item_image"><img src="/assets/img/icons/melee-attack.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="agi+sk"></div>
                            <div class="item_image"><img src="/assets/img/icons/ranged-attack.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true" data-calc="gei+au-pa"></div>
                            <div class="item_image"><img src="/assets/img/icons/spellcasting.png"></div>
                        </div>
                        <div class="nsc_skill" style="width: 12.5%;">
                            <div class="skill_edit" contenteditable="true"  data-calc="gei+sk-pa"></div>
                            <div class="item_image"><img src="/assets/img/icons/targeted-spellcasting.png"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="nsc_notes p-0" colspan="3" contenteditable="true">

                    <div class="half_table half_first text-right woodstamp" style="width:10%">Notizen:</div> 
                    <div class="half_table " contenteditable="true" style="width:90%"></div>      
                </td>
            </tr>
            
            
        </tbody>
    </table>
</div>