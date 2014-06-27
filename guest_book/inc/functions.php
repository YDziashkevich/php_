<?php
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
    }else{
        $error=array(" ", " ", " ", " ");
    }

    return $error;
}

/**
 * генерируем форму
 * @return string
 */
function get_Form()
{
    $errors=valid_Form();
    $html=file_get_contents("./tpl/head.html");
    $html=$html.file_get_contents("./tpl/formName.html");
    $html=$html.$errors[0];
    $html=$html.file_get_contents("./tpl/formEmail.html");
    $html=$html.$errors[1];
    $html=$html.file_get_contents("./tpl/formMessage.html");
    $html=$html.$errors[2];
    $html=$html."<table class=\"captcha\"><tr><td>". get_Captcha(). "</td><td>".file_get_contents("./tpl/captcha.html")."</td></tr></table>";
    $html=$html.$errors[3];
    $html=$html.file_get_contents("./tpl/footer.html");
    return $html;
}

