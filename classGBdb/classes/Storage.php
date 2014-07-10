<?php
class Storage {
    private $messages=array();
    private $host = 'localhost';
    private $dbName = 'guestBook_st';
    private $user = 'root';
    private $pass = '';
    private $db;

    public function __construct(){
        try{
            $this->db = new PDO("mysql: host=$this->host; dbname=$this->dbName", $this->user, $this->pass);
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function __destruct(){
        $this->db=null;
    }
    
    /**
     * метод читает хранилеще в массив
     * @return array строковый массив с сообщениями
     */
    public function getStorage(){
        $this->db->query("SET CHARACTER SET utf8");
        $query=$this->db->query("SELECT * FROM st_userMessage");
        $this->messages=$query->fetchAll();
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
        foreach($messages as $message){
$htmlMessage=<<<'EOT'
<p class="pMessage"><span class="nameEmail"> {{1}} {{2}} </span></br>
<span class="messages"> {{3}} </span></br>
<span class="date"> {{4}} </span></p>
EOT;
            foreach($message as $key=>$value){
                switch($key){
                    case 1:
                        $htmlMessage=str_replace("{{1}}", $value, $htmlMessage);
                        break;
                    case 2:
                        $htmlMessage=str_replace("{{2}}", $value, $htmlMessage);
                        break;
                    case 3:
                        $htmlMessage=str_replace("{{3}}", $value, $htmlMessage);
                        break;
                    case 4:
                        $htmlMessage=str_replace("{{4}}", $value, $htmlMessage);
                        break;
                }

            }
            $strMessages.=$htmlMessage;
        }
        return $strMessages;
    }

    public function putMes(){

        $data = array( 'name' => $_POST["name"], 'email' => $_POST["email"], 'message' => $_POST["message"],
        'date' => date("H:i m.d.y"));
        $STH = $this->db->prepare("INSERT INTO st_userMessage (name, email, message, date) value (:name, :email, :message, :date)");
        $STH->execute($data);
    }
}