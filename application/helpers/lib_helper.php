<?php 
if(!function_exists('generate_number')){
    function generate_number($str){
        $str = number_format($str,0,',','.');
        return $str;
    }
}

?>