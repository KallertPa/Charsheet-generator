<?php 

/**
 * creates a table that can be edited 
 * 
 */

?>

<div class="table-editable">
    <table class="variable_height table table-bordered text-left">
        <thead>
            <tr>
            <?php foreach( $table_header as $h =>$header){ ?>
                <?php 
                $width = ''; 
                if(isset($table_header_width[$h])){
                    $width = 'style="width: '.$table_header_width[$h].'%"';
                } ?>
                <th class="text-left" contenteditable="true" <?=$width ?>><?=$header ?></th>
            <? } ?>
                <th class="text-left remove_in_element">Aktionen</th>
                <? if($show_calc){ ?>
                    <th class="text-left show_on_hover">Berechnung</th>
                <? } ?>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < $table_row_count; ++$i) {?>
                <tr>
                    <?php foreach($table_header as $key => $header){ ?>
                        <td contenteditable="true">
                            <?php if(isset($table_default[$i][$key])){ 
                                echo $table_default[$i][$key];
                            } ?>
                        </td>

                    <?php } ?>
                    <td class="remove_in_element">
                        <span class="table-remove"><i class="fas fa-minus-square"></i></span>
                    </td>
                    <? if($show_calc){ ?>
                        <td class="show_on_hover custom_calc" contenteditable="true"></td>
                    <? } ?>
                </tr>

            <? } ?>   
            
        </tbody>
    </table>
</div>

