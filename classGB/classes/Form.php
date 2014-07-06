<?php
class Form {
    private $input=array();
    private $dataForm=array();
    private $errors=array();
    /*
    public function __construct(){
        $this->error=" ";
        $this->input=" ";
        $this->dataForm=" ";
        $this->messages=" ";
        $this->paginator=" ";
    }*/

    /**
     * метод генерирует INPUT и заносит строку с HTML в массив $input
     * @param $attributes атрибуты для INPUT
     * @param $value значение для поля INPUT
     * @param $inputName метка для какой части гостевой книги генерируем INPUT
     */
    public function getInput($attributes, $value, $inputName){
        $formInput="<input {{ATTRIBUTES}} value='{{VALUE}}'>";
        $formInput=str_replace("{{ATTRIBUTES}}", $attributes, $formInput);
        $formInput=str_replace("{{VALUE}}", $value, $formInput);
        if($inputName=="name"){
            $this->input["name"]=$formInput;
        }
        if($inputName=="email"){
            $this->input["email"]=$formInput;
        }
        if($inputName=="message"){
            $this->input["message"]=$formInput;
        }
    }

    /**
     * метод для генерирования каптчи, значение выражения каптчи заносится в сессию
     * строку с выражением каптчи заносит в массив $input
     */
    public function getCaptcha(){
        $a=rand(10, 18);
        $b=rand(1, 9);
        $symbol=(rand(0, 1))?"+":"-";
        switch ($symbol){
            case "+":
                $ans=$a+$b;
                $captchaText="$a+$b"."=";
                break;
            case "-":
                $ans=$a-$b;
                $captchaText="$a-$b"."=";
                break;
        }
        $_SESSION["ans"]=$ans;
        $this->input["captcha"]=$captchaText;
    }

    /**
     * метод для получения ввденных знчение в форму
     * @param $postName ключ имени в _POST
     * @param $postEmail ключ почты в _POST
     * @param $postMessage ключ сообщения в _POST
     */
    public function getDataForm($postName, $postEmail, $postMessage){
        /*var_dump($postName);
        var_dump($postEmail);
        var_dump($postMessage);*/

        isset($_POST["name"])?$this->dataForm["name"]=$_POST["name"]:" ";
        isset($_POST["email"])?$this->dataForm["email"]=$_POST["email"]:" ";
        isset($_POST["message"])?$this->dataForm["message"]=$_POST["message"]:" ";
        /*if(isset($_POST[$postMessage]) && (!empty($_POST[$postMessage]))){
            setcookie('message', $_POST['message'], 3600*60*60);
        }*/
        isset($_POST["captcha"])?$this->dataForm["captcha"]=$_POST["captcha"]:"";
    }

    /**
     * метод для проверки введенных пользователем данных
     * ошибки заносит в массив $error
     * @return bool
     */
    public function validateForm(){
        $validation = true;
        if(isset($_POST)&&!empty($_POST)){
            if(!preg_match('/^\D{3,}$/', $this->dataForm["name"])){
                $validation = false;
                $this->errors['name'] = "Имя пользователя должно содержать не менее 3 символов";
                $_POST['name']=" ";
            }else{
                $this->errors['name'] = " ";
            }
            if(!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',$this->dataForm["email"])){
                $validation = false;
                $this->errors['email'] = "Неправильно введен email. Должен быть вида example@mail.com";
                $_POST['email']=" ";
            }else{
                $this->errors['email'] = " ";
            }
            if(strlen($this->dataForm["message"])<15){
                $validation = false;
                $this->errors['message'] = "Сообщение пользователя должно содержать не менее 15 символов";
                $_POST['message']=" ";
            }else{
                $this->errors['message'] = " ";
            }
            if($this->dataForm['captcha']!=$_SESSION["ans"]){
                $validation = false;
                $this->errors['captcha'] = "Неправильный ответ";
            }else{
                $this->errors['captcha'] = " ";
            }
        }else{
            $this->errors['name'] = " ";
            $this->errors['email'] = " ";
            $this->errors['message'] = " ";
            $this->errors['captcha'] = " ";
        }
        if(!$validation){
            return false;
        }else{
            return true;
        }
    }

    public function getHtml($messages=" ", $paginator=" "){
        $htmlPage=file_get_contents("./tpl/page.tpl");
        $htmlPage=str_replace("{{NAME}}",$this->input["name"],$htmlPage);
        $htmlPage=str_replace("{{EMAIL}}",$this->input["email"],$htmlPage);
        $htmlPage=str_replace("{{MESSAGE}}",$this->input["message"],$htmlPage);
        $htmlPage=str_replace("{{CAPTCHA}}",$this->input["captcha"],$htmlPage);
        $htmlPage=str_replace("{{ERRORNAME}}",$this->errors["name"],$htmlPage);
        $htmlPage=str_replace("{{ERROREMAIL}}",$this->errors["email"],$htmlPage);
        $htmlPage=str_replace("{{ERRORMESSAGE}}",$this->errors["message"],$htmlPage);
        $htmlPage=str_replace("{{ERRORCAPTCHA}}",$this->errors["captcha"],$htmlPage);
        $htmlPage=str_replace("{{MESSAGES}}",$messages,$htmlPage);
        $htmlPage=str_replace("{{PAGINATOR}}",$paginator,$htmlPage);
        return $htmlPage;
    }
} 