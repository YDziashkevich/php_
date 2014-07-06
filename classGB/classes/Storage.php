<?php
class Storage {
    private $messages=array();

    /**
     * метод читает хранилеще в массив
     * @return array строковый массив с сообщениями
     */
    public function getStorage(){
        $this->messages=file("./data/messages.txt");
        $this->messages=array_reverse($this->messages);
        return $this->messages;
    }

    /**
     * метод для получения HTML строки с срезом сообщений
     * @param $pageCount массив с текущей страницей и количеством сообщений на странице
     * @return string HTML строка с сообщениями
     */
    public function getMessages($pageCount){
        $strMessages="";
        $startIndex = ($pageCount["page"]-1)*$pageCount["count"];
        $messages=array_slice($this->messages, $startIndex, $pageCount["count"]);
        foreach($messages as $value){
$htmlMessage=<<<'EOT'
<p class="pMessage"><span class="nameEmail"> {{1}} {{2}} </span></br>
<span class="messages"> {{3}} </span></br>
<span class="date"> {{4}} </span></p>
EOT;
            $message=explode("[***]",$value);
            $i=1;
            foreach($message as $value1){
                $search='{{'.$i.'}}';
                $htmlMessage=str_replace($search, $value1, $htmlMessage);
                $i++;
                }
            $strMessages.=$htmlMessage;
        }
        return $strMessages;
    }

    public function putMes(){
        $del="[***]";
        $str="";
        if(isset($_POST) && !empty($_POST)){
            $str=$_POST["name"].$del.$_POST["email"].$del.$_POST["message"].$del.date("H:i m.d.y")."\n";
        }
        file_put_contents("./data/messages.txt", $str, FILE_APPEND);
    }
}