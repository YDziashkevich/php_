<?php

/**
 * 
 */
function my_ksort($mass, $flag='')
{   
    $size=count($mass);
    $sortArray=array();
    $returnArray=array();
    
    foreach ($mass as $value){
        $sortArray[]=$value;
    }
    
    for ($i=0; $i < $size; $i++)
    {
        for ($y=($i+1); $y < $size; $y++)
        {
            if ($sortArray[$i] < $sortArray[$y])
            {
                $c = $sortArray[$i];
                $sortArray[$i] = $sortArray[$y];
                $sortArray[$y] = $c;
            }
        }
    }
    foreach ($sortArray as $key1=>$value1){
        foreach ($mass as $key2=>$value2){
            if($value1==$value2){
                $returnArray[$key2]=$value1;
            }
        }
    }
    
    return $returnArray;
}



$mass=array(11=>8, 22=>5, 33=>2, 44=>3, 55=>6, 66=>9, 77=>7, 88=>4, 99=>1, 100=>0);
var_dump(my_ksort($mass));

$mass1=array(8, "fgdsgf", 2, 3, "dfgd", 6);
var_dump(arsort($mass1));
foreach ($mass1 as $value){
    echo "$value"."\n";
}