<?php

/**
 * 
 */
function my_substr($string="", $start=0, $stop=0)
{
    $i=0;
    $string_="";
    var_dump($start);
    var_dump($stop);
    if($start>0 && $start<strlen($string) && $stop==0){
        for($i=$start; $i<=(strlen($string));$i++){
            $string_=$string_.$string{$i};            
        }
    }
    if($start<0 && abs($start)<strlen($string) && $stop==0){
        for($i=0; $i<=(strlen($string))-abs($start)-1;$i++){
            $string_=$string_.$string{$i};            
        }
    }
    if($start>0 && $stop>0 && $start<strlen($string) && $stop<strlen($string)){
        for($i=$start; $i<=(strlen($string)-$stop-1);$i++){
            $string_=$string_.$string{$i};            
        }
    }
    
     if($start<0 && $stop>0 && abs($start)<strlen($string) && $stop<strlen($string)){
        if(abs($start)>$stop || abs($start)==$stop){
            for($i=abs($start); $i<=(strlen($string)-$stop-1);$i++){
            $string_=$string_.$string{$i};            
            } 
        } else{
            for($i=$stop; $i<=(strlen($string)-abs($start)-1);$i++){
            $string_=$string_.$string{$i}; 
            }
        }
     }/*
     if($start<0 && $stop<0 && abs($start)<strlen($string) && abs($stop)<strlen($string)){
        if(abs($start)>abs($stop)){
            for($i=abs($start); $i>=(strlen($string)-abs($stop));$i--){
            $string_=$string_.$string{$i};            
            } 
        } else{
            for($i=abs($stop); $i>=(strlen($string)-abs($start));$i--){
            $string_=$string_.$string{$i}; 
            }
        }
     }
     if($start>0 && $stop<0 && $start<strlen($string) && abs($stop)<strlen($string)){
        if($start>abs($stop)){
            for($i=$start; $i>=(strlen($string)-abs($stop));$i--){
            $string_=$string_.$string{$i};            
            } 
        } else{
            for($i=abs($stop); $i>=(strlen($string)-$start);$i--){
            $string_=$string_.$string{$i}; 
            }
        }
     }
     if($start==0 && $stop==0){
         $string_=$string;
     }
     
     */
    return $string_;
}

$str="Hello world";
var_dump(my_substr($str,-2,3));
