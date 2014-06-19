<?php

/**
 * 
 */
function my_str_shuffle($string_){
    $i=0;
    $index_=rand(0,  strlen($string_));
    $tmp=array($index_);
    $tmp1=array();
    $new_string="";
    while(count($tmp)<strlen($string_)){
        $index_=rand(0,  strlen($string_));
        foreach ($tmp as $value){
            if($index_ != $value){
                $tmp[]=$index_;
            }                
        }                
    }
    for($i=0; $i<strlen($string_); $i++){
        $tmp1[]=$string_{$tmp[$i]};
    }
    //var_dump($tmp1);
    var_dump($tmp);
    /*foreach ($tmp1 as $value1){
        $new_string=$new_string.$value1;
    }*/
return $new_string;
}

var_dump("Hello world");
var_dump(my_str_shuffle("Hello world"));
