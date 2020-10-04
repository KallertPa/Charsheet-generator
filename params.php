<?php 
error_reporting(-1);



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
        ['img' => 'throwing.png', 'title' => 'Werfen', 'text' => 'KÖR+GE'],
        ['img' => 'eye.png', 'title' => 'Wahrnehmen', 'text' => 'GEI+VE oder 8'],
        ['img' => 'handwerk.png', 'title' => 'Handwerk', 'text' => 'GEI+GE'],
    ];
    

/**
 * Get the browser name for specific styles 
 * see https://gist.github.com/james2doyle/5774516
 */

  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';  

  // Next get the name of the useragent 
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
    $bname = 'InternetExplorer';
  } elseif(preg_match('/Firefox/i',$u_agent)) {
    $bname = 'MozillaFirefox';
  } elseif(preg_match('/Chrome/i',$u_agent)) {
    $bname = 'GoogleChrome';
  } elseif(preg_match('/Safari/i',$u_agent)) {
    $bname = 'AppleSafari';
  } elseif(preg_match('/Opera/i',$u_agent)) {
    $bname = 'Opera';
  } elseif(preg_match('/Netscape/i',$u_agent)) {
    $bname = 'Netscape';
  }

