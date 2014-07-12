<?php

require_once("./inc/inc.php");

$validate;

$registration=new Registration();

$registration->validateForm();

$registration->getCaptcha();


var_dump($_POST);
if($validate AND !empty($_POST)){
    $page=$registration->getUserInfo();
    var_dump($page);

    header('Location:./tpl/tmp.html');
    exit();
}
$htmlPage=$registration->getPage();
    echo $htmlPage;



