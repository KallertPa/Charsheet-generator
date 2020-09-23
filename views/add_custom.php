
<div class="col-md-5 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="9" data-gs-height="5">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table">
                <?php
                //since we have a lot of custom stuff in the equipment table, use custom table view 
                    require('views/table_equip.php'); 
                ?>

            </div>

        </div>
    </div>
</div>

<div class="col-md-5 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="10" data-gs-height="5">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table">
                <?php require('views/table_char.php'); ?>

            </div>
        </div>
    </div>
</div>
<div class="col-md-2 extra_table_elements fix_height" style="display: none;">
    <div class="newWidget grid-stack-item " data-gs-width="2" data-gs-height="28">
        <div class="grid-stack-item-content no_padding bg-white text-center">
            <img src="./assets/img/lifebar.png" />
        </div>
    </div>
</div>

<div class="col-md-6 extra_table_elements"  style="display: none;">
    <div class=" newWidget grid-stack-item" data-gs-width="10" data-gs-height="6">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table">
                <?php
            //since we have a lot of custom stuff in the equipment table, use custom table view 
                require('views/table_steps.php'); 
            ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 extra_table_elements fix_height"  style="display: none;">
    <div class=" newWidget grid-stack-item" data-gs-width="10" data-gs-height="6">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="area_money">
                <?php
            //since we have a lot of custom stuff in the equipment table, use custom table view 
                require('views/area_money.php'); 
            ?>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="10" data-gs-height="6">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table nsc_table">
                <?php require('views/table_nsc.php'); ?>

            </div>
        </div>
    </div>
</div>