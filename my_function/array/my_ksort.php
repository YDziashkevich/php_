<?php

/**
 * 
 */
function my_ksort($mass, $flag='')
{   
    $size=count($mass);
    $sortArray=array();
    $returnArray=array();
    
    foreach ($mass as $key=>$value){
        $sortArray[]=$key;
    }
    for ($i=0; $i < $size; $i++)
    {
        for ($y=($i+1); $y < $size; $y++)
        {
            if ($sortArray[$i] > $sortArray[$y])
            {
                $c = $sortArray[$i];
                $sortArray[$i] = $sortArray[$y];
                $sortArray[$y] = $c;
            }
        }
    }
    foreach ($sortArray as $key1=>$value1){
        foreach ($mass as $key2=>$value2){
            if($value1==$key2){
                $returnArray[$value1]=$value2;
            }
        }
    }
    
    return $returnArray;
}



$mass=array(00=>8, 11=>5, 88=>2, 22=>3, 77=>6, 33=>9, 66=>7, 44=>4, 55=>1, 100=>0);
var_dump($mass);
var_dump(my_ksort($mass));

