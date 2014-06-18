<?php

define("KEY_C", 7); 

/**
 * Шифрованние текста с помощью XOR
 * @param string $str_ строка которую необходимо зашифровать 
 * @return string зашифрованная строка
 */
function en_de_crytp($str_)
{
    $tmp=array();
    $i=0;
    while(isset($str_{$i})){
        $asciiKey=ord($str_{$i});
        $tmp[]=$asciiKey^KEY_C;
        $i++;
    }
    $i=0;
    $crypt_str="";
    while(isset($tmp[$i])){
        $crypt_str=$crypt_str.(chr($tmp[$i]));
        $i++;
    }
    return $crypt_str;
}

$encrypt=en_de_crytp(file_get_contents("file_crypt.txt"));
file_put_contents("file_encrypt.txt", $encrypt);

$decrypt=en_de_crytp(file_get_contents("file_encrypt.txt"));
file_put_contents("file_decrypt.txt", $decrypt);