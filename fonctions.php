<style type="text/css">
 div.error-debug{
     background-color :#272727; 
     padding:20px;
     color:#ccccbb;
     margin-bottom:20px;
 }

div.error-ligne{
     background-color :#ef590e;   
     padding:10px;
     color:#f0e5df;
     font-family:verdana;
     font-style:italic;
     margin-top:20px;
 }
div.error-ligne strong{
     background-color :#882d00; 
     padding:2px 15px;
     display:inline-block;
     margin-right:10px;
     
 }
div.error-debug pre{
    background:#313131;
    padding : 25px;
}
strong.var_name{
    float: right;
}
</style>

<?php

function debug($var = false,$die = false, $showHtml = false, $showFrom = true) {
    

    $root =  dirname(dirname(dirname(__FILE__)));
    if ($showFrom) {
        $calledFrom = debug_backtrace();
        echo '<div class="error-ligne">';
        echo '<strong>' . $calledFrom[0]['line'] .'</strong>';
        echo substr(str_replace($root, '', $calledFrom[0]['file']), 1);
        echo  '<strong class="var_name">'.var_name($var).'</strong></div>';
    
    }
    echo '<div class="error-debug">';
    echo "\n<pre>\n";

    $var = print_r($var, true);
    if ($showHtml) {
        $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
    }
    echo $var . "\n</pre>\n";
    echo '</div>';
    if($die){
        die();
    }

}


function var_name($var)
{
   $defk = 'pas de valeur php';
   foreach($GLOBALS as $k => $v) 
    if (!is_array($k) && $v == $var) return($k);
   return($defk);
}

?>