<?php
/**
 * Basic Dungeonslayer Charsheet Generator 
 * 
 * For Gridstack 0.6.0 Docs see https://github.com/gridstack/gridstack.js/tree/115c3d259c0cba3188644983d20c45eb1cf6de63/doc
 * 
 * @package    Charsheet generator
 * @author     kallertp@gmail.com
 */



require_once('params.php'); 
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dungeonslayer Charsheet Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/gridstack.css" />
    <link rel="stylesheet" href="./assets/css/gridstack-extra.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.6.9/shim.min.js"></script>
    <script src="/assets/js/gridstack.all.js"></script>
    <link rel="stylesheet" href="/assets/css/fontawsome/css/all.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/print.css" />
</head>

<body>

<!---->
    <div class="row d-print-none">
        <div class="col-lg-12 text-white text-center">
            <h1>Dungeonslayer Charsheet Generator</h1>
        </div>
    </div>
    <div class="">
    <div class="row">
        <div class="col-sm-6 col-md-6 dungeonslayer-content" style="padding-bottom: 25px;">
            <div style="border: 1px solid white">
                <div class="grid-stack grid-stack-20" id="advanced-grid" data-gs-column="20" data-gs-max-row="28"
                    data-gs-animate="yes">
                    <div class="grid-stack-item no_padding " data-gs-x="0" data-gs-y="0" data-gs-width="2" data-gs-height="28"
                        data-gs-no-move="yes" data-gs-no-resize="yes" data-gs-locked="yes">
                        <div class="grid-stack-item-content  bg-white">
                            <img src="./assets/img/lifebar.png" />

                        </div>
                    </div>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide ui-draggable-disabled ui-resizable-disabled" data-gs-x="2" data-gs-y="0" data-gs-width="18" data-gs-height="11" data-gs-no-move="true"
                        data-gs-no-resize="true" data-gs-locked="true">
                        <div class="grid-stack-item-content  bg-white standardd-values">

                            <?php require_once('views/header.php'); ?>
                        </div>
                    </div>


                    <?php
                    //load the default skills
                    require_once('views/default_skills.php') ?>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide"
                    data-gs-x="2" data-gs-y="17" data-gs-width="9" data-gs-height="5">
                        <div class="grid-stack-item-content ui-draggable-handle">
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
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide"
                    data-gs-x="11" data-gs-y="17" data-gs-width="9" data-gs-height="5">
                    <div class="grid-stack-item-content ui-draggable-handle">
                        <div class="added_table">
                            <?php
                            //since we have a lot of custom stuff in the equipment table, use custom table view 
                                require_once('views/table_equip.php'); 
                            ?>

                        </div>

                    </div>
                    </div>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide"
                    data-gs-x="2" data-gs-y="22" data-gs-width="9" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Talent', 'Rang', 'Effekt'];
                                    $table_header_width = ['', '5', ''];
                                    $table_row_count = 10;  
                                    $table_default = array(); 

                                    require('views/default_table.php'); 
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide"
                    data-gs-x="11" data-gs-y="22" data-gs-width="9" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Ausrüstung'];
                                    $table_header_width = array(); 
                                    $table_row_count = 10;  
                                    $table_default = array(); 
                                    
                                    require('views/default_table.php'); 
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-6 d-none d-md-block" style="border-right: 1px dashed black;">
            <div class="row top-items-edit  d-print-none ">
                <div class="col-md-12 d-flex">
                    <div id="trash" class="text-center text-white top-button">
                            <i class="fas fa-trash-alt"></i>
                            <span>Trash</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3 class="text-white">Fähigkeiten hinzufügen</h3>
                </div>
                
                <div class="col-md-12 text-white">
                    <p><strong>Tipp:</strong> Die Fähigkeit kann per Drag & Drop in das Sheet verschoben werden</p>
                </div>
                <div class="col-md-4">
                    <div class="text-white  grid-stack-item top-button">
                        
                        <a href="#" class="open_dialog full_width btn" data-dialog="skill">
                            <i class="fas fa-plus"></i>
                            <span>Neue Fähigkeit</span>
                        </a>
                        
                    </div>
                   
                </div>
                <div class="col-md-2 d-flex">

                    <div class="text-center newWidget grid-stack-item no_padding"  data-gs-width="2" data-gs-height="3">
                        <div class=" grid-stack-item-content">
                            <div class="added_item skill_item">
                                <div class="skill_edit"  contenteditable="true"></div>
                                <div class="item_image"><img src="./assets/img/melee-attack.png"></div>
                                <div class="item_title">Überschrift</div>
                                <div class="item_text">Attribute</div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3 class="text-white">Tabelle hinzufügen</h3>
                </div>
                <div class="col-md-12 text-left table-add-container text-white">
                    <p><strong>Tipp:</strong>Mit Rechtsklick können Tabelleninhalte bearbeitet werden</p>    
                </div>
                <div class="col-md-12 text-right table-add-container text-white">
                    <span class="table-add "><a href="#!" class="text-success"><i
                        class="fas fa-plus-square" aria-hidden="true"></i> Reihe hinzufügen</a></span>
                    <span class="table-add-column"><a href="#!" class="text-success"><i
                            class="fas fa-plus-square" aria-hidden="true"></i> Spalte hinzufügen</a></span>
                            
                    <span class="table-remove-column"><a href="#!" class="text-success"><i
                        class="fas fa-minus-square" aria-hidden="true"></i> Spalte entfernen</a></span>
                </div>

                <div class="col-md-12">
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

                <div class="col-md-12">
                    <h3 class="text-white">Speichern und Laden</h3>
                </div>
                <div class="col-md-12 table-add-container text-white">
                   <a href="#" id="save_grid" class="text-success save_content "><i class="fas fa-save" aria-hidden="true"></i> speichern</a>
                   <a href="#" id="load_grid"class="text-success open_dialog" data-dialog="load"><i class="fas fa-upload" aria-hidden="true"></i> laden</a>
                </div>


            
            </div>
        </div>
    </div>
    </div>
    <div id="dialog" style="display: none;">

        <?php
        //load all files in the dialog view
        foreach (glob("views/dialog/*.php") as $filename) { 
            $file_stuff = ['views/dialog/', '.php']; 
            $name = str_replace($file_stuff, '', $filename); ?>
            <div class="dialog_<?php echo $name; ?> dialog">
                <div class="text-right">
                    <a href="#" class="close_dialog"><i class="fas fa-times pull-right"></i></a>
                </div>
                <?php include $filename; ?> 
            </div>
        <?php } ?>
    </div>
    <div id="black_overlay" style="display: none; "></div>


    <script src="./assets/js/script.js"></script>
</body>

</html>