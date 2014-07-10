<?php

class Paginator {
    private $numPage;

    /**
     * метод для получения количества страниц с сообщениями
     * @param array $messages массив с сообщениями
     */
    public function getCountPage($messages=array()){
        $size=count($messages);
        $page=isset($_GET["count"])?(int)$_GET["count"]:10;
        $numPage=$size/$page;
        $numPage=((int)$numPage==$numPage)?$numPage:(int)$numPage+1;
        $this->numPage=$numPage;
    }

    /**
     * метод для получения в виде строки HTML пагинатора
     * @param $pageCount массив с текущей строкой и количеством сообщений
     * @return string строка с HTML
     */
    public function getHtmlPaginator(&$pageCount){
    $curPageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;
    $curNumMess = isset($_GET['count']) ? (int)$_GET['count']: 10;
    $html = "<div clas='divPaginator'>page:";
    $html .="<ul class='paginator'>";
    for($i = 1; $i <= $this->numPage; $i++){
        if($i == $curPageNum){
            $html .= "<li >$i</li>";
            $pageCount["page"]=$i;
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
            $pageCount["count"]=10;
            $html.="<li><a href='?page=$curPageNum&count=15'>15</a></li>";
            $html.="<li><a href='?page=$curPageNum&count=20'>20</a></li>";
            break;
        case 15:
            $html.="<li><a href='?page=$curPageNum&count=10'>10</a></li>";
            $html.="<li>15</li>";
            $pageCount["count"]=15;
            $html.="<li><a href='?page=$curPageNum&count=20'>20</a></li>";
            break;
        case 20:
            $html.="<li><a href='?page=$curPageNum&count=10'>10</a></li>";
            $html.="<li><a href='?page=$curPageNum&count=20'>15</a></li>";
            $html.="<li>20</li>";
            $pageCount["count"]=20;
            break;
    }
    $html .= "</ul></div>";
    return $html;
    }
}