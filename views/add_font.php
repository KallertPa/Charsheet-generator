<div class="col-md-12 change_fonts" style="display: none;">
  <div><span class="strong">Schriftart der Seite</span></div>

  <select name="font" id="fonts">
  <?php
      //load all files in the dialog view
      foreach (glob("assets/fonts/*.ttf") as $filename) { 
          $file_stuff = ['assets/fonts/', '-Regular', '.ttf']; 
          $name = str_replace($file_stuff, '', $filename); ?>
          <option value="<?php echo $name ?>" class="<?php echo $name ?>"><?php echo $name ?></option>
    <?php } ?>
  </select>
</div>
<div class="col-md-12 change_fonts" style="display: none;">
  <div><span class="strong">Textfarbe ändern</span></div>
  <div class="pickr-container"></div>
  <a href="#" id="change_color" class=""text-succcess><i class="fas fa-fill-drip"></i>Auswahl einfärben </a>
</div>
<div class="col-md-12 change_fonts" style="display: none;">
  <div><span class="strong">Schriftart der Auswahl</span></div>

  <select name="font" id="font_selection">
  <?php
      //load all files in the dialog view
      foreach (glob("assets/fonts/*.ttf") as $filename) { 
          $file_stuff = ['assets/fonts/', '-Regular', '.ttf']; 
          $name = str_replace($file_stuff, '', $filename); ?>
          <option value="<?php echo $name ?>" class="<?php echo $name ?>"><?php echo $name ?></option>
    <?php } ?>
  </select>
  <a href="#" id="change_font" class=""text-succcess><i class="fas fa-pen-fancy"></i>Auswahl ändern </a>
</div>