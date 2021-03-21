<?php
/**
 * Basic Dungeonslayer Charsheet Generator 
 * 
 * For Gridstack 2.2.0 Docs see https://cdn.jsdelivr.net/npm/gridstack@2.2.0/README.md
 * 
 * @package    Charsheet generator
 * @author     kallertp@gmail.com
 */

//version for styles and scripts 
$version = 1.7; 

require('params.php'); 
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dungeonslayer Charsheet Generator</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <script src="./assets/js/popper.min.js?v=<?php echo $version ?>"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />

    <link rel="stylesheet" href="./assets/css/gridstack.css" />
    <link rel="stylesheet" href="./assets/css/gridstack-extra.css?v=<?php echo $version ?>" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.6.9/shim.min.js"></script>
    <script src="/assets/js/gridstack.all.js?v=<?php echo $version ?>"></script>
    <link rel="stylesheet" href="/assets/css/fontawsome/css/all.css" />
    <link rel="stylesheet" href="/assets/css/style.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="/assets/css/print.css?v=<?php echo $version ?>" />

    <?php
    //load a special file for browser-specific stuff
    $filepath = '/assets/css/'.strtolower($bname).'.css'; 
    if (file_exists(dirname(__FILE__) . $filepath)) { ?>
        <link rel="stylesheet" href="<?=$filepath ?>?v=<?php echo $version ?>" />
    <?php } ?>
</head>

<body>


    <?php //actions that are positioned absolute at top of page  ?>
    <div class="actions d-print-none">
        <a href="#page_1" class="btn scroll_to"><i class="fas fa-scroll"></i> Seite 1</a>
        <a href="#page_2" class="btn scroll_to"><i class="fas fa-scroll"></i> Seite 2</a>
        <a href="#page_3" class="btn scroll_to"><i class="fas fa-scroll"></i> Seite 3</a>
        <a href="#" class="btn save_as save_grid_local" style="display: none; "><i class="fas fa-save"
                aria-hidden="true"></i> "<span class="char_name"></span>" speichern</a>
    </div>

    <?php //heading on top of the page  ?>
    <div class="row d-print-none">
        <div class="col-lg-12 text-white text-center">
            <h1>Dungeonslayer Charsheet Generator</h1>
        </div>
    </div>

    <?php
    //messages for success and error messages 
    include_once('views/messages.php'); ?>
    <div class="content_container">
        <div class="switch_absolute d-print-none">
            <a href="#" class="text-success open_dialog open_save_dialog" data-dialog="save">
                        <i class="fas fa-save" aria-hidden="true"></i> speichern unter</a>
            <a href="#" id="export_grid" class="text-success save_content ">
                
                <i class="fas fa-file-download"></i>
                exportieren</a>
            <a href="#" id="load_grid" class="text-success open_dialog" data-dialog="load"><i class="fas fa-upload"
                    aria-hidden="true"></i> laden</a>
            <a href="#" id="undo_grid" class="text-success"><i class="fas fa-redo"></i> neuen Char</a>
            <label class="switch">
                <input type="checkbox" class="checkbox" id="auto_calc">
                <span class="slider round"></span>
            </label>Werte automatisch berechnen
        </div>
        <div class="row">


            <div class="col-sm-6 d-print-none" id="page_1">
                <h2 class="page_title">Seite 1</h2>
            </div>
            <div class="col-sm-6 d-print-none"></div>

            <div class="col-sm-6 col-md-6 dungeonslayer-content">
                <div class="grid-stack grid-stack-20" id="advanced-grid" data-gs-column="20" data-gs-max-row="28"
                    data-gs-animate="yes">

                    <?php 
                        //the lifebar on the left side ?>
                    <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="2" data-gs-height="28">
                        <div class="grid-stack-item-content no_padding bg-white lifebar">
                            <img src="./assets/img/lifebar.png" />

                        </div>
                    </div>

                    <?php 
                        //the header with the stats and char details ?>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide ui-draggable-disabled ui-resizable-disabled"
                        data-gs-x="2" data-gs-y="0" data-gs-width="18"  data-gs-min-width="18" data-gs-height="11" data-gs-min-height="11">
                        <div class="grid-stack-item-content  bg-white standardd-values">
                            <?php require('views/header.php'); ?>
                        </div>
                    </div>

                    <?php
                        //load the default skills
                        require('views/default_skills.php') ?>

                    <?php 
                        //the weapons table ?>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="2"
                        data-gs-y="17" data-gs-width="9" data-gs-height="5">
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

                    <?php 
                        //the equipment table ?>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="11"
                        data-gs-y="17" data-gs-width="9" data-gs-min-width="6" data-gs-height="5" data-gs-min-height="5">
                        <div class="grid-stack-item-content ui-draggable-handle show-overflow">
                            <div class="added_table">
                                <?php
                                        require('views/table_equip.php'); 
                                    ?>

                            </div>

                        </div>
                    </div>

                    <?php 
                        //the talent table ?>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="2"
                        data-gs-y="22" data-gs-width="9" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle show-overflow">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Talent', 'Rang', 'Effekt'];
                                    $table_header_width = ['', '5', ''];
                                    $table_row_count = 10;  
                                    $table_default = array(); 
                                    $show_calc = true;
                                    require('views/default_table.php'); 
                                    $show_calc = false; 
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                        //a very empty equipment table ?>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="11"
                        data-gs-y="22" data-gs-width="9" data-gs-height="6">
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



            <div class="col-sm-6 d-none d-md-block edit_stuff">
                <div class="row top-items-edit  d-print-none ">
                    <div class="col-md-12 area_toggle" data-toggle="help">
                        <h3 class="first_element">Hilfe - wie funktioniert das?</h3>
                    </div>

                    <div class="col-md-12 help">
                        <ul>
                            <li>Die verschiedenen Tabellen und Elemente können von der Rechten Seite auf das
                                Charakterblatt gezogen werden</li>
                            <li>Die Elemente können größer und kleiner gezogen werden. Bei Tabellen werden dann auch
                                Zeilen hinzugefügt und entfernt</li>
                            <li>Grau hinterlegte Felder können bearbeitet werden, Tabellenüberschriften auch </li>
                            <li>Wenn die automatische Berechnung aktiviert ist, können in der Rüstungs- und Talenttabellen die Werte in der Spalte 'Berechnung' geändert werden, z.b mit laufen+1 oder agi-1</li>
                            <li>Zum Drucken einfach die Funktion vom Browser verwenden (Str+P)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 area_toggle" data-toggle="add-skill">
                                <h3>Fähigkeiten hinzufügen</h3>
                            </div>

                            <div class="col-md-6 add-skill">
                                <div class="grid-stack-item top-button">

                                    <a href="#" class="open_dialog full_width btn" data-dialog="skill">
                                        <i class="fas fa-plus"></i>
                                        <span>Fähigkeit</span>
                                    </a>

                                </div>

                            </div>
                            <div class="col-md-6 add-skill">

                                <div class="text-center newWidget grid-stack-item " data-gs-width="2" data-gs-min-width="2"
                                    data-gs-height="3">
                                    <div class=" grid-stack-item-content no_padding">
                                        <div class="added_item skill_item">
                                            <div class="skill_edit" contenteditable="true"></div>
                                            <div class="item_image"><img src="./assets/img/icons/melee-attack.png">
                                            </div>
                                            <div class="item_title">Überschrift</div>
                                            <div class="item_text">Attribute</div>
                                        </div>

                                    </div>
                                    <div class="drag_handler ui-draggable-handle"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 hide_icon area_toggle" data-toggle="change_fonts">
                                <h3 class="">Schrift</h3>
                            </div>

                            <? require('views/add_font.php');?>
                            <style>
                                <?php //load all files in the dialog view

                                foreach (glob("assets/fonts/*.ttf") as $filename) {
                                    $file_stuff=['assets/fonts/',
                                    '-Regular',
                                    '.ttf'];
                                    $name=str_replace($file_stuff, '', $filename);
                                    ?>
                                @font-face
                                {
                                font-family:
                                <?php echo $name ?>;
                                src:
                                url(/<?php echo $filename ?>)
                                }
                                .<?php echo $name ?> {
                                font-family:
                                <?php echo $name ?>
                                }
                                <?php
                                }

                                ?>
                            </style>
                        </div>
                    </div>


                    <div class="col-md-12 area_toggle" data-toggle="table-add-container">
                        <h3 class="">Tabelle hinzufügen</h3>
                    </div>
                    <? require('views/add_tables.php');?>

                    <div class="col-md-12 hide_icon area_toggle" data-toggle="extra_table_elements">
                        <h3 class="">Elemente hinzufügen</h3>
                    </div>

                    <? require('views/add_custom.php');?>

                    <div class="col-md-12 area_toggle" data-toggle="remove-container">
                        <h3 class="">Elemente entfernen</h3>
                    </div>
                    <div class="col-md-12 text-left remove-container ">
                        <p>Einfach ein Element auf das Feld ziehen und schon ist es weg</p>
                    </div>
                    <div class="col-md-12 remove-container">
                        <div id="trash" class="text-center  top-button">
                            <i class="fas fa-trash-alt"></i>
                            <span>Trash</span>
                        </div>
                    </div>



                </div>
            </div>
        </div>


        <div class="row second_content">
            <div class="col-sm-6  d-print-none" id="page_2">
                <h2 class="page_title">Seite 2</h2>
            </div>


            <div class="col-sm-6 d-print-none"></div>
            <div class="col-sm-6 col-md-6 dungeonslayer-content">
                <div class="grid-stack grid-stack-20" id="second-grid" data-gs-column="20" data-gs-max-row="28"
                    data-gs-animate="yes">

                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="0"
                        data-gs-y="0" data-gs-width="10" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php 
                                    require('views/table_steps.php'); 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="10"
                        data-gs-y="0" data-gs-width="10" data-gs-height="6" data-gs-min-height="4" data-gs-min-width="7">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="area_money">
                                <?php
                            //since we have a lot of custom stuff in the equipment table, use custom table view 
                                require('views/area_money.php'); 
                            ?>

                            </div>

                        </div>
                    </div>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="0"
                        data-gs-y="6" data-gs-width="10" data-gs-height="13">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Ausrüstung', 'Wo gelagert?', 'Besonderes'];
                                    $table_header_width = array();
                                    $table_row_count = 24;  
                                    $table_default = array(); 

                                    require('views/default_table.php'); 
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="10"
                        data-gs-y="6" data-gs-width="10" data-gs-height="11">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Kräuter, Tränke, Artefakte', 'Effekt'];
                                    $table_header_width = [50, 50]; 
                                    $table_row_count = 20;  
                                    $table_default = array(); 
                                    
                                    require('views/default_table.php'); 
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="0"
                        data-gs-y="19" data-gs-width="10" data-gs-height="9">
                        <div class="grid-stack-item-content ui-draggable-handle show-overflow">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Talent', 'Rang', 'Effekt'];
                                    $table_header_width = ['', 5, '']; 
                                    $table_row_count = 16;  
                                    $table_default = array(); 
                                    $show_calc = true;
                                    require('views/default_table.php'); 
                                    $show_calc = false; 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="10"
                        data-gs-y="17" data-gs-width="10" data-gs-height="5">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php require('views/table_char.php'); ?>

                            </div>
                        </div>
                    </div>
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="10"
                        data-gs-y="22" data-gs-width="10" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php require('views/table_nsc.php'); ?>

                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <div class="row second_content">
            <div class="col-sm-6  d-print-none" id="page_3">
                <h2 class="page_title">Seite 3</h2>
            </div>


            <div class="col-sm-6 d-print-none"></div>
            <div class="col-sm-6 col-md-6 dungeonslayer-content">
                <div class="grid-stack grid-stack-20" id="third-grid" data-gs-column="20" data-gs-max-row="28"
                    data-gs-animate="yes">
                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="0"
                        data-gs-y="0" data-gs-width="10" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php require('views/table_nsc.php'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide" data-gs-x="10"
                        data-gs-y="0" data-gs-width="10" data-gs-height="6">
                        <div class="grid-stack-item-content ui-draggable-handle">
                            <div class="added_table">
                                <?php 
                                    $table_header = ['Ausrüstung', 'Wo gelagert?', 'Besonderes'];
                                    $table_header_width = array();
                                    $table_row_count = 9;  
                                    $table_default = array(); 

                                    require('views/default_table.php'); 
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-sm-6 d-print-none"></div>
        <div class="row d-print-none" id="footer">
            <div class="col-md-12 text-center">
                <a href="/credits.php">Credits</a>
            </div>
        </div>
    </div>

    <script src="./assets/js/dialog.js?v=<?php echo $version ?>"></script>
    <script src="./assets/js/font.js?v=<?php echo $version ?>"></script>
    <script src="./assets/js/skills.js?v=<?php echo $version ?>"></script>
    <script src="./assets/js/general.js?v=<?php echo $version ?>"></script>
    <script src="./assets/js/script.js?v=<?php echo $version ?>"></script>
    <script src="./assets/js/table.js?v=<?php echo $version ?>"></script>

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
            <?php require $filename; ?>
        </div>
        <?php } ?>
    </div>
    <div id="black_overlay" style="display: none; "></div>

</body>

</html>