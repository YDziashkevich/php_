<?php

echo <<<END
<form method='post' enctype='multipart/form-data' action='index.php'>
    <input type='hidden' name='MAX_FILE_SIZE' value='200000' />
    <input name='userFile' type='file' />
    <input type='submit' value='Отправить' />
</form>
END;

$dir="./images/";
$upfile = $dir.basename($_FILES['userFile']['name']);
$type = $_FILES['userFile']['type'];
$validation = false;

switch($type){
    case 'image/gif':
    case 'image/jpeg':
    case 'image/pjpeg':
    case 'image/png':
        $validation = true;
        break;
    default:
        //echo "Данный тип файла не поддерживается<br />";
        break;
}

if($validation){
    if(move_uploaded_file($_FILES['userFile']['tmp_name'],$upfile)){
        echo "Файл успешно загружен<br />";
    }else{
        echo "Загрузить файл не удалось<br />";
    }
}else{
    echo "Файл слишком большой или некорректного формата<br />";
}
foreach (glob("images/*") as $filename)
{
    echo '<img src="'.$filename.'" src="" width="200px"  /><br /><br />';
}