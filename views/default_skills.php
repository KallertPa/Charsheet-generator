<? 
/**
 * Loop through the default skills defined in skills.php
 */

$pos_x = 2; 
$pos_y = $header_height; 

foreach($default_skills as $skill){ ?>
    <div class="grid-stack-item no_padding ui-draggable ui-resizable ui-resizable-autohide" 
        data-gs-x="<?=$pos_x ?>" 
        data-gs-y="<?=$pos_y ?>"
        data-gs-width="<?=$skills_w ?>" 
        data-gs-height="<?=$skills_h ?>">
        <div class="grid-stack-item-content  bg-white standardd-values">
            <div class="added_item skill_item">
                <?php if(isset($skill['img'])){ ?>
                    <div class="skill_edit"  contenteditable="true"></div>
                    <div class="item_image"><img src="/assets/img/<?=$skill['img']; ?>"></div>
                <?php } ?>
                <?php if(isset($skill['title'])){ ?>
                    <div class="item_title"><?=$skill['title']; ?></div>
                <?php } ?>
                <?php if(isset($skill['title'])){ ?>
                    <div class="item_text"><?=$skill['text']; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>

    <? 
    //add to move the skills to the right 
    $pos_x += $skills_w; 

    //if we are at the end of the line, go to new line 
    if(($pos_x + $skills_w) > 20){
        $pos_x = 2; 
        $pos_y += $skills_h; 
    }
    
    ?>

<?php }


