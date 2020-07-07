<?php
$name = "";
$message = "";
 
if(isset($_POST['send']) === true){
    $name = $_POST["name"];
    $message = $_POST["message"];
   #テキストファイルに$name,$messageを書き込む処理
 
}
 
 
?>