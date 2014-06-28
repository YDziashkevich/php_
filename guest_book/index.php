<?php
require_once("./inc/inc.php");
require_once("./inc/functions.php");

$errors=valid_Form();
if($errors[4]==0){
    $data=putMes();
    //header('Location: '.$_SERVER['REQUEST_URI']);
}
$mes=getMessage();
$page=get_Form($errors, $mes);
echo $page;




