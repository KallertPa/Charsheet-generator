<div class="text-center">
    <h2>Elemente hinzufügen</h2>
</div>
<div class="row text-center">
    <?php
      //load all files in the dialog view
      foreach (glob("assets/img/icons/*") as $filename) { 
          $file_stuff = ['assets/img/icons']; 
          $name = str_replace($file_stuff, '', $filename); ?>
          <div class="col-sm-1 p-0">
            <label class="p-1">
                <input type="radio" name="icon" value="<?php echo $name ?>">
                <img src="./assets/img/icons/<?php echo $name ?>">
            </label>
        </div>
    <?php } ?>
    
</div>
<label class="width-100" for="new_item_title">Überschrift </label>
<input type='text' id="new_item_title" placeholder="text" /><br />
<label class="width-100" for="new_item_text">Text </label>
<input type='text' id="new_item_text" placeholder="text" /><br />
<div class="text-right">
    <a href="#" class="btn" id="change_image">übernehmen</a>
</div>