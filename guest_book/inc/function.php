<?php
date_default_timezone_set('UTC');
/*------------------------*/
function getForm($error=array(), $captcha, $message=array(), $paginator)
{
    $startIndex = ((int)$_GET["page"]-1)*(int)$_GET["count"];
    $message=array_slice($message, $startIndex, (int)$_GET["count"]);
    $html="";
    $html.=file_get_contents("./tpl/head.tpl");
    $html.=file_get_contents("./tpl/formName.tpl");
    $html.=$error[0];
    $html.=file_get_contents("./tpl/formEmail.tpl");
    $html.=$error[1];
    $html.=file_get_contents("./tpl/formMessage.tpl");
    $html.=$error[2];
    $html.=file_get_contents("./tpl/formCaptcha.tpl");
    $html.=$captcha;
    $html.=file_get_contents("./tpl/formCaptchaEnd.tpl");
    $html.=file_get_contents("./tpl/formButton.tpl");
    $html.=$error[3];
    $html.=file_get_contents("./tpl/formEnd.tpl");
    foreach($message as $value){
        $htmlMessage=explode("[***]",$value);
        $strMessage=htmlMessage($htmlMessage);
        $html.=$strMessage;
    }
    $html.=$paginator;
    $html.=file_get_contents("./tpl/footer.tpl");
    return $html;
}

/**
 * функция для генерирование каптчи, правильный ответ передается в $_SESSION
 * @return string строка c выражением для каптчи
 */
function getCaptcha()
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
 * проверка првильного ответа каптчи
 * @return bool
 */
function validCaptcha()
{
    if(isset($_SESSION["ans"])){
        if($_SESSION["ans"]==$_POST["captcha"]){
            $validAns=true;
        }else{
            $validAns=false;
        }
    }else{
        $validAns=false;
    }
    return $validAns;
}

/**
 * функция для создания массива с сообщениями, и подсчета количества сраниц
 * @param $messages массив с сообщениями
 * @param int $page количествоо сообщений на страницу
 * @return float|int количество страниц
 */
function getMessages(&$messages, $page=10)
{
    $messages=file("./data/messages.txt");
    $messages=array_reverse($messages);
    $size=count($messages);
    $numPage=$size/$page;
    $numPage=((int)$numPage==$numPage)?$numPage:(int)$numPage+1;
    return $numPage;
}

/**
 * проверка формы на правильность введенной информации
 * @return array массив с ошибками
 */
function validForm()
{
    $error=array();
    if(isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["message"]) || isset($_SESSION["ans"])){
        ($_POST["name"])?$name=$_POST["name"]:$name=" ";
        ($_POST["email"])?$email=$_POST["email"]:$email=" ";
        ($_POST["message"])?$message=$_POST["message"]:$message="";
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
        if(!validCaptcha()){
            $error[]="incorrectly entered captcha";
            $flag++;
        }else{
            $error[]="";
        }
        $error[]=$flag;
    }else{
        $error=array(" ", " ", " ", " ", 4);
    }
    return $error;
}

/**
 * шаблон для вывода сообщений
 * @param array $message массив частей сообщения
 * @return string html сообщения
 */
function htmlMessage($message=array())
{
    $spanBr=file_get_contents("./tpl/spanBr.tpl");
    $spanP=file_get_contents("./tpl/spanP.tpl");
    $html=file_get_contents("./tpl/messNameEmail.tpl").$message[0]."\t".$message[1].$spanBr.
        file_get_contents("./tpl/messMess.tpl").$message[2].$spanBr.
        file_get_contents("./tpl/messDate.tpl").$message[3].$spanP;
    return $html;
}

/**
 * функция возвращает html пагинатора
 * @param $countPage количество странциц с собщениями
 * @return string строка списка пагинации и вывода количества сообщений на страницу
 */
function getPaginatorHtml($countPage){
    $curPageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;
    $curNumMess = isset($_GET['count']) ? (int)$_GET['count']: 10;
    $urlMask="?page=$curPageNum & count=$curNumMess";
    $html = "<div clas='divPaginator'>page:";
    $html .="<ul class='paginator'>";
    for($i = 1; $i <= $countPage; $i++){
        if($i == $curPageNum){
            $html .= "<li >$i</li>";
        } else {
            $html .= "<li><a href='?page=$i&count=$curNumMess'>$i</a></li>";
        }
    }
    $html .= "</ul></div>";
    $html .= "<div clas='divPaginator'>number of posts per page:";
    $html .="<ul  class='paginator'>";
    switch($curNumMess){
        case 10:
            $html.="<li>10</li>";
            $html.="<li><a href='?page=$curPageNum&count=15'>15</a></li>";
            $html.="<li><a href='?page=$curPageNum&count=20'>20</a></li>";
            break;
        case 15:
            $html.="<li><a href='?page=$curPageNum&count=10'>10</a></li>";
            $html.="<li>15</li>";
            $html.="<li><a href='?page=$curPageNum&count=20'>20</a></li>";
            break;
        case 20:
            $html.="<li><a href='?page=$curPageNum&count=10'>10</a></li>";
            $html.="<li><a href='?page=$curPageNum&count=20'>15</a></li>";
            $html.="<li>20</li>";
            break;
    }
    $html .= "</ul></div>";
    return $html;
}
function putMes()
{
    $del="[***]";
    $str=$_POST["textName"].$del.$_POST["textEmail"].$del.$_POST["textMessage"].$del.date("H:i m.d.y")."\n";
    return file_put_contents("./data/messages.txt", $str, FILE_APPEND);
}