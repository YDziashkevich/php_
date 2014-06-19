<?php

/** ‘ункци€ удал€ет повтор€ющиес€ элементы массива с сохранением ключа
 * 
 *@param array $array_ вход€щий массив
 *@return array
 */
function my_array_unique($array_)
{
    $tmp=array();
    foreach($array_ as $key => $value){
        foreach($array_ as $key1 => $value1){
        if($key!=$key1){
          if($array_[$key]==$array_[$key1]){
              unset($array_[$key1]);
          }
        }
        }
    }
    return $array_;
}

$array_=array(4, "4", "3", 4, 3, "3");
var_dump(my_array_unique($array_));