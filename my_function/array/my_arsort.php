<?php

/**
 * 
 */
function my_arsort($mass_)
{
    $size=count($mass_);
    $array_=array();
    for ($i=0; $i < $size; $i++)
    {
        for ($y=($i+1); $y < $size; $y++)
        {
            if ($mass_[$i] > $mass_[$y])
            {
                $c = $mass_[$i];
                $mass_[$i] = $mass_[$y];
                $mass_[$y] = $c;
            }
        }
    }
    return $mass_;
}

$mass=array(8, 5, 2, 3, 6, 9, 7, 4, 1, 0);
var_dump($mass);
var_dump(my_arsort($mass));