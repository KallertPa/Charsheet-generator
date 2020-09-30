<?php 
/**
 * Popup for loading a Character 
 * from a file or from the browser 
 */
?>

<div class="text-center">
    <h2>Datei hochladen</h2>
</div>
    <input id="json_file" type="file" />
<div id="output" style="display: none;"></div>
<div class="text-right">
    <a href="#" class="btn" id="load_data">Character aus Datei laden</a>
</div>


<div id="char_list" style="display:none;">
    <div class="text-center">
        <h2>Aus dem Browser laden</h2>
    </div>
    <p>Einen Charakter aus dem Browser laden</p>
    <select id="load_char_list" name="load_char_list" list="available_chars">
    </select>
    <div class="text-right">
        <a href="#" class="btn" id="load_local_data">Character aus Browser laden</a>
    </div>
</div>