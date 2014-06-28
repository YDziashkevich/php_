<?php
date_default_timezone_set('UTC');

/**
 * генерируем капчу
 * @return string выражение отображаемое в форме
 */
function get_Captcha()
{
    $a=rand(25, 50);
    $b=rand(1, 25);
    $sym=(rand(0, 1))?"+":"-";
    switch ($sym){
        case "+":
            $ans=$a+$b;
            $exp="$a+$b"."=";
            break;
        case "-":
            $ans=$a-$b;
            $exp="$a-$b"."=";
            break;
    }
    $_SESSION["ans"]=$ans;
    return $exp;
}

/**
 * проверяем капчу
 * @return bool
 */
function valid_Captcha()
{
    if($_SESSION["ans"]==$_POST["textCaptcha"]){
            $valid_ans=true;
    }else{
        $valid_ans=false;
    }
    return $valid_ans;
}

/**
 * проверка введенных данных в форму производится при условии если хоть в одно
 * текстовое поле были введены данные
 * @return array массив с сообщениями об ошибке
 */
function valid_Form()
{
    $error=array();
    if(isset($_POST["textName"]) || isset($_POST["textEmail"]) || isset($_POST["textMessage"])){
        ($_POST["textName"])?$name=$_POST["textName"]:$name=" ";
        ($_POST["textEmail"])?$email=$_POST["textEmail"]:$email=" ";
        ($_POST["textMessage"])?$message=$_POST["textMessage"]:$message="";
        $flag=0;
        if(strlen($name) < 5){
            $error[]="name is entered incorrectly";
            $flag++;
        }else{
            $error[]="";
        }
        if(strlen($email) < 5){
            $error[]="incorrectly entered email";
            $flag++;
        }else{
            $error[]="";
        }
        if(strlen($message) < 50){
            $error[]="invalid message";
            $flag++;
        }else{
            $error[]="";
        }
        if(!valid_Captcha()){
            $error[]="incorrectly entered captcha";
            $flag++;
        }else{
            $error[]="";
        }
        $error[]=$flag;
    }else{
        $error=array(" ", " ", " ", " ", 0);
    }

    return $error;
}

/**
 * генерируем форму
 * @return string
 */
function get_Form($errors=array(), $mes=array())
{
    $html=file_get_contents("./tpl/head.html");
    $html=$html.file_get_contents("./tpl/formName.html");
    $html=$html."</br>".$errors[0];
    $html=$html.file_get_contents("./tpl/formEmail.html");
    $html=$html."</br>".$errors[1];
    $html=$html.file_get_contents("./tpl/formMessage.html");
    $html=$html."</br>".$errors[2];
    $html=$html."<table class=\"captcha\"><tr><td>". get_Captcha(). "</td><td>".file_get_contents("./tpl/formCaptcha.html")."</td></tr></table>";
    $html=$html."</br>".$errors[3]."</br></br>";
    foreach($mes as $value){
        $tmp=explode("[***]", $value);
        $html.=htmlMes($tmp);
    }
    $html=$html.file_get_contents("./tpl/footer.html");
    return $html;
}

/**
 * возвращает отсортированный массив сообщений
 * @return array
 */
function getMessage()
{
    $messages=file("./data/messages.txt");
    $messages=array_reverse($messages);
    return $messages;
}

/**
 * подсчитывает количество страниц с собщениями
 * @param array $mes
 * @param int $page
 * @return float
 */
function getNumPage($mes=array(), $page=10){
    $size=count($mes);
    $numMes=$size/$page;
    $numMes_=((int)$numMes==$numMes)?$numMes:(int)$numMes+1;
    return $numMes;
}

/**
 * Взвращает html для сообщения
 * @param array $mes
 * @return string
 */
function htmlMes($mes=array())
{
    $str="<p>".$mes[0]."\t".$mes[1]."</br>".$mes[2]."</br>".$mes[3]."</p>";
    return $str;
}

/**
 * Функция добовляющая запись сообщения
 * @return int
 */
function putMes()
{
    $del="[***]";
    $str=$_POST["textName"].$del.$_POST["textEmail"].$del.$_POST["textMessage"].$del.date("H:i m.d.y");
    return file_put_contents("./data/messages.txt", $str, FILE_APPEND);
}