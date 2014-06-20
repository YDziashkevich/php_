<?php

function my_decrypt($url){
	
	$text = file_get_contents($url);
	
	$text = str_split($text);
	
	$all = array_count_values($text);
	
	arsort(&$all);
	$keys = array_keys($all);
	$key = array_shift($keys);
	
	$enc_key = ord($key)^ord(" ");
	$str = '';
	
	for($i=0;$i<count($text);$i++){
		$str .= chr(ord($text[$i])^$enc_key);
	}
	
	file_put_contents("wk_decrypt.txt", $str);
}
my_decrypt("file_encrypt.txt");
