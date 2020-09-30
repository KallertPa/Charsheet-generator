<div class="col-md-12 text-right table-add-container ">
    <a href="#" class="text-success table-add" ><i class="fas fa-plus-square" aria-hidden="true"></i> Reihe hinzufügen</a>
    <a href="#" class="text-success table-add-column"><i class="fas fa-plus-square " aria-hidden="true"></i> Spalte hinzufügen</a>
    <a href="#" class="text-success table-remove-column"><i class="fas fa-minus-square" aria-hidden="true"></i> Spalte entfernen</a>
</div>

<div class="col-md-12 table-add-container ">
    <div class="text-center newWidget grid-stack-item " data-gs-width="9" data-gs-height="5">
        <div class=" grid-stack-item-content">
            <div class="added_table">
            <?php 
                $table_header = ['Waffen', 'WB', 'Gesamt', 'INI', 'GA', 'Besonderes'];
                $table_row_count = 8;  
                $$table_header_width = array(); 
                $table_default = array(); 
                $table_default[0] = ['Waffenlos', '+0', '', '', '+5']; 

                require('views/default_table.php'); 
            ?>
            </div>
        </div>
    </div>
</div>

