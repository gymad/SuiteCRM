<?php

$notfound = 0;
$founds = array();

$styles = strtolower(file_get_contents("/var/www/SuiteCRM/themes/SuiteP/css/style.css"));
$colors = strtolower(file_get_contents("/var/www/SuiteCRM/themes/SuiteP/themedef.php"));

preg_match_all('/\#[0-f]{3,6}/', $styles, $matches);
echo "found ".count($matches[0])." color\n";

foreach($matches[0] as $color) {
    //echo "check: $color .. ";
    
    //if(strpos($colors, $color)===false) {
//	echo "not defined: $color\n";
//	$notfound++;
//    }
//    else {
//	echo "found\n";
//    }
    if(!in_array($color, $founds)) {
        $founds[] = $color;
    }
}
echo "founds: ".count($founds)."\n";