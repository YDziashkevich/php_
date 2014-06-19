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
    if( $len==0 ){    
        while ( isset($string1{$i}) ){
            $tmp1=$tmp1.ord( $string1{$i} );
            $i++;
        }
        while ( isset($string2{$j}) ){
            $tmp2=$tmp2.ord( $string2{$j} );
            $j++;
        }
    }   elseif($len<=strlen($string1) && $len<=strlen($string2)){
        while($i<$len){
            $tmp1=$tmp1.ord($string1{$i});
            $i++;
        }
        while($j<$len){
            $tmp2=$tmp2.ord($string2{$j});
            $j++;
        }
    }   else{
        $tmp="Error";
    }
    $tmp=$tmp1-$tmp2;
    return $tmp;
}

var_dump(my_strncmp("qw", "World",2));