<?php
require_once("./inc/inc.php");
require_once("./inc/function.php");

$message=array();

$errors=validForm();
$captcha=getCaptcha();
$numPage=getMessages($message, isset($_GET["count"])?$_GET["count"]:10);
if($errors[4]==0){
    $data=putMes();
    //header('Location: '.$_SERVER['REQUEST_URI']);
}
//header('Location: '.$_SERVER['REQUEST_URI']);
$htmlPaginator=getPaginatorHtml($numPage);
$page=getForm($errors, $captcha, $message, $htmlPaginator);
echo $page;