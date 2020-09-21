<?php 
error_reporting(-1);

//height of the main content 
$header_height = 11; 


/**
 * The default Skills that are first shown when the user loads the page 
 */

    $skills_w = 2; 
    $skills_h = 3; 
    $default_skills = [
        ['img' => 'hit-points.png', 'title' => 'Lebenskraft', 'text' => 'KÖR+HÄ+10'],
        ['img' => 'defense.png', 'title' => 'Abwehr', 'text' => 'KÖR+HÄ+PA'],
        ['img' => 'initiative.png', 'title' => 'Initiative', 'text' => 'AGI+BE'],
        ['img' => 'movement-rate.png', 'title' => 'Laufen', 'text' => '(AGI/2)+1'],
        ['img' => 'melee-attack.png', 'title' => 'Schlagen', 'text' => 'KÖR+ST'],
        ['img' => 'ranged-attack.png', 'title' => 'Schießen', 'text' => 'AGI+GE'],
        ['img' => 'hit-points.png', 'title' => 'Werfen', 'text' => 'KÖR+GE'],
        ['img' => 'hit-points.png', 'title' => 'Wahrnehmen', 'text' => 'GEI+VE oder 8'],
        ['img' => 'hit-points.png', 'title' => 'Handwerk', 'text' => 'GEI+GE'],
    ];