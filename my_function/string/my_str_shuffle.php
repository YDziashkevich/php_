<?php
/**
 * 
 * @param type $string_
 * @return type
 */
function my_str_shuffle($string_){
    $i=0;
    $tmp=array();
    $tmp1=array();
 
    $max = strlen($string_) - 1;
    $min = 0;
    $index_=rand($min, $max);
    while(count($tmp)<strlen($string_)){  
        while(in_array($index_, $tmp)){
            $index_=rand($min, $max);
            // Это нужно для уменьшения числа итераций
            if($index_ == $max){
            $max = $max - 1;
            } else if ($index_ == $min) {
            $min = $min + 1;
            }   
        };
    flush();
    $tmp[]=$index_;                 
    }
    for($i=0; $i<strlen($string_); $i++){
        $tmp1[]=$string_{$tmp[$i]};
    }
    return implode($tmp1);
}

var_dump("Hello world");
var_dump(my_str_shuffle("Hello world"));