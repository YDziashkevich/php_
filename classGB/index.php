<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');


$postName="name";
$postEmail="email";
$postMessage="message";
$error=array();
$arrayMessages=array();
$pageCount=array();
$attrForm=array("postName"=>$postName, "postEmail"=>$postEmail, "postMessage"=>$postMessage, "valueName"=>$valueName,
    "valueEmail"=>$valueEmail, "valueMessage"=>$valueMessage);

isset($_POST['name'])?$valueName=$_POST['name']:$valueName=" ";
isset($_POST['email'])?$valueEmail=$_POST['email']:$valueEmail=" ";
isset($_POST['message'])?$valueMessage=$_POST['message']:$valueMessage=" ";

$form=new Form($attrForm);
$messages=new Storage();
$paginator=new Paginator();

$form->getDataForm($postName, $postEmail, $postMessage);

$validate=$form->validateForm();
if($validate AND !empty($_POST)){
    $messages->putMes();
    header('Location: '.$_SERVER['REQUEST_URI']);
    exit();
}

$form->getCaptcha();

$arrayMessages=$messages->getStorage();

$paginator->getCountPage($arrayMessages);
$htmlPaginator=$paginator->getHtmlPaginator($pageCount);

$htmlMessages=$messages->getMessages($pageCount);

$page=$form->getHtml($htmlMessages, $htmlPaginator);

echo $page;