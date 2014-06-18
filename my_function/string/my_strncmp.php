<?php

/**
 * 
 */
function my_strncmp($string1, $string2, $len=0)
{
    $i=0;
    $j=0;
    $tmp1="";
    $tmp2="";
    if($len==0){
        while(isset($string1{$i})){
            $tmp1=$tmp1.ord($string1{i});
            $i++;
        }
        while(isset($string2{$j})){
            $tmp2=$tmp2.ord($string2{j});
            $j++;
        }
    }
    $tmp=$tmp1-$tmp2;
    var_dump($tmp);
    return $tmp;
    if($len>0){
        for($i=0; $i<=$len; $i++){
            $tmp1=$tmp1.ord($string1{i});
            $i++;
        }
        for($j=0; $j<=$len; $j++){
            $tmp2=$tmp2.ord($string2{j});
            $j++;
        }
    }
    $tmp=$tmp1-$tmp2;
    var_dump($tmp);
    return $tmp;
}

my_strncmp(xczxcvxcvxcvxcvxcv, yhfghfghfghfgh, 5);