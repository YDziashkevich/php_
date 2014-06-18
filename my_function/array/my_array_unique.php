<?php

/**
 * 
 */
function my_array_unique($array_)
{
    $tmp=array();
    var_dump($array_);
    foreach($array_ as $key => $value){
        foreach($array_ as $key1 => $value1){
        if($array_[$key]==$array_[$key1]){
            unset($array_[$key1]);
        }
        }
    }
    var_dump($array_);
    return $array_;
}

$array_=array(4, "4", "3", 4, 3, "3");
var_dump(my_array_unique($array_));