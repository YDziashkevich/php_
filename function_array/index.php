<?php
/**
 * Extract a slice of the array
 * 
 * @param array $array_ the input array
 * @param int $offset start offset array
 * @param int $length end of slice
 * @return array returns the slice
 */
function my_slice_array(array $array_, $offset, $length)
{
    $tmp=array();
    $j=0;
    foreach($array_ as $value){
        if($j>=$offset && $j<$length){
            $tmp[$j]=$value;            
        }
        $j++;
    }
    return $tmp;
}

$test_array=array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
var_dump(my_slice_array($test_array, 4, 8));

/**
 * return size array
 * 
 * @param array $array the input array
 * @return int returns size 
 */
function size_array(array $array_s)
{
    $i=0;
    foreach($array_s as $value){
        $i++;
    }
    return $i;
}

$test_array_2=array(2, 8, 7, 5, 9, 6, 1, 0, 3, 4);
var_dump(size_array($test_array_2));


/**
 * end array
 * 
 * @param array $array_end input array
 * @return mixed returns the last element of the array
 */
function end_array(array $array_end)
{
    $tmp1=array();
    $k=0;
    foreach($array_end as $value){
        $tmp[$k]=$value;
        $k++;
    }
    return $tmp[$k-1];
}

var_dump(end_array($test_array_2));
