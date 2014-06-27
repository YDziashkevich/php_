<?php
define('PAGE_SIZE',6);

function getStorage(){
	return file('storage.txt');
}

function getStorageSize(array $storage){
	return count($storage);
}

function getItemHtml(array $item){
	$html = '<li>'.$item['title'].' - '.$item['descr'].' : '.$item['price'].'</li>';
	return $html;
}

function getPageCount($count, $size){
	$tmp = $count/$size;
	return ((int)$tmp == $tmp)? $tmp: (int)$tmp + 1;
}

function getStoragePage($storage, $pageNum, $pageSize){
	$startIndex = ($pageNum - 1)*$pageSize;
	return array_slice($storage, $startIndex, $pageSize);
}

function getPaginatorHtml($urlMask, $count, $current){
	$html = "";
	$html .="<ul>";
	for($i = 1; $i <= $count; $i++){
		if($i == $current){
			$html .= "<li >$i</li>";
		} else {
			$html .= "<li><a href='".str_replace( '{ID}', $i, $urlMask)."'>$i</a></li>";
		}		
	}
	$html .= "</ul>";
	return $html;
}

function parseItem($str){
	$arr = array();
	
	$tmp = explode(';', $str);
	
	$arr['title'] = $tmp[0];
	$arr['descr'] = $tmp[1];
	$arr['price'] = $tmp[2];
	
	return $arr;
}


$storage = getStorage();
echo '<pre>';print_r($storage); echo '</pre>';
$storageSize = getStorageSize($storage);
$pageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;
$pagesCount = getPageCount($storageSize, PAGE_SIZE);

$pageItems = getStoragePage($storage, $pageNum, PAGE_SIZE);

echo '<ul>';
foreach($pageItems as $str){
	$item = parseItem($str);
	echo getItemHtml($item);
}

echo '</ul>';

echo getPaginatorHtml('?page={ID}', $pagesCount, $pageNum);