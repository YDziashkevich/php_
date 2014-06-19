<?php
//*******************************************
function size_array(array $array_s)
{
    $i=0;
    foreach($array_s as $value){
        $i++;
    }
    return $i;
}
//*******************************************
/**
 * 
 */
function size_str($str)
{
$i=0;    
while(isset($str{$i})){
        $i++;
    }
    return $i;
}

var_dump(size_str("Hello World"));

/**
 * 
 */
function my_implode($glue, array $array_)
{   
    $string="";
    for($i=0; $i<size_array($array_); $i++){
        $string=$string.$array_[$i];
        if(isset($array_[$i+1])){
            $string=$string.$glue;
        }
    }
    return $string;
}

$my_mas=array("25", "qwerty", "ZZZ");
$my_mas_str=my_implode("_", $my_mas);
var_dump($my_mas_str);

/**
 * 
 */
function my_explode($del, $myString){
    $tmp=array(null);
    $ret_str="";
    $j=0;
    for($i=0; $i<size_str($myString);$i++){
        if($myString[$i]!=$del && isset($myString[$i])){
        $ret_str=$ret_str.$myString[$i];
        }  
        else{
            $tmp[$j]=$ret_str;
            $ret_str="";
            $j++;
        }
        
    }
    return $tmp;
}
$my_mas_str="25_qwerty_ZZZ";
var_dump(my_explode("_", $my_mas_str));

