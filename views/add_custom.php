<?php // Equipment Table ?>
<div class="col-md-5 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="9" data-gs-height="5">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table">
                <?php
                    require('views/table_equip.php'); 
                ?>

            </div>

        </div>
    </div>
</div>
<?php // Character Details table?>
<div class="col-md-5 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="10" data-gs-height="5">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table">
                <?php require('views/table_char.php'); ?>

            </div>
        </div>
    </div>
</div>
<?php // Lifebar ?>
<div class="col-md-1 extra_table_elements fix_height" style="display: none;">
    <div class="newWidget grid-stack-item " data-gs-width="2" data-gs-height="28">
        <div class="grid-stack-item-content no_padding bg-white text-center">
            <img src="./assets/img/lifebar.png" />
        </div>
    </div>
</div>
<?php // Big Lifebar ?>
<div class="col-md-1 extra_table_elements fix_height" style="display: none;">
    <div class="newWidget grid-stack-item " data-gs-width="2" data-gs-height="28">
        <div class="grid-stack-item-content no_padding bg-white text-center">
            <img src="./assets/img/lifebar_big.png" />
        </div>
    </div>
</div>
<?php // Beute & Vermögen ?>
<div class="col-md-6 extra_table_elements fix_height"  style="display: none;">
    <div class=" newWidget grid-stack-item" data-gs-width="10" data-gs-height="6">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="area_money">
            <?php
                require('views/area_money.php'); 
            ?>
            </div>
        </div>
    </div>
</div>
<?php // NSC-Begleiter ?>
<div class="col-md-6 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="10" data-gs-height="6">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table nsc_table">
                <?php require('views/table_nsc.php'); ?>

            </div>
        </div>
    </div>
</div>
<?php // Zauber-Liste ?>
<div class="col-md-12 extra_table_elements" style="display: none;">
    <div class="newWidget grid-stack-item" data-gs-width="20" data-gs-height="8">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table table_magicians">
            <?php 
                $table_header = ['Zauber', 'ZB', '<img src="./assets/img/icons/spellcasting.png">', 
                    '<img src="./assets/img/icons/targeted-spellcasting.png" />', 
                    'Gesamt', 'Distanz', 'Dauer', '<img src="./assets/img/flask.png" />', 'Effekt'];
                $table_row_count = 2;  
                $table_header_width = ['', '4', '5', '5', '', '', '', '4', '']; 
                $table_default = array(); 
                $table_default[0] = array(); 

                require('views/default_table.php'); 
            ?>
            </div>
        </div>
    </div>
</div>
<?php // LP-Verwaltung ?>
<div class="col-md-8 extra_table_elements"  style="display: none;">
    <div class=" newWidget grid-stack-item" data-gs-width="10" data-gs-height="6">
        <div class="grid-stack-item-content ui-draggable-handle">
            <div class="added_table">
            <?php
                require('views/table_steps.php'); 
            ?>
            </div>
        </div>
    </div>
</div>