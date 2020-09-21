<?php 

/**
 * creates a table that can be edited 
 * 
 */

?>

<div id="table" class="table-editable">
    <table class="table table-bordered table-responsive-md text-left">
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
                </tr>

            <? } ?>   
        </tbody>
    </table>
</div>

