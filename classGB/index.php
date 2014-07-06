<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$form=new Form();
$messages=new Storage();
$paginator=new Paginator();

$postName="name";
$postEmail="email";
$postMessage="message";
$error=array();
$arrayMessages=array();
$pageCount=array();
isset($_POST['name'])?$valueName=$_POST['name']:$valueName=" ";
isset($_POST['email'])?$valueEmail=$_POST['email']:$valueEmail=" ";
isset($_POST['message'])?$valueMessage=$_POST['message']:$valueMessage=" ";

$form->getInput("type='text' name='$postName' class='inputName'", $valueName, $postName);
$form->getInput("type='text' name='$postEmail' class='inputEmail'", $valueEmail, $postEmail);
$form->getInput("type='text' name='$postMessage' class='inputMessage'", $valueMessage, $postMessage);

$form->getDataForm($postName, $postEmail, $postMessage);
$form->getCaptcha();

$validate=$form->validateForm();
if($validate){
    $messages->putMes();
    //header('Location: '.$_SERVER['REQUEST_URI']);
}

$arrayMessages=$messages->getStorage();

$paginator->getCountPage($arrayMessages);
$htmlPaginator=$paginator->getHtmlPaginator($pageCount);

$htmlMessages=$messages->getMessages($pageCount);

$page=$form->getHtml($htmlMessages, $htmlPaginator);

echo $page;