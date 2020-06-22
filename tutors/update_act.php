<?php
session_start();
include("funcs.php");
$pdo = db_conn();

$sql = "UPDATE calendar_table SET TUTOR = :TUTOR WHERE id = :id";
 
// // 更新する値と該当のIDは空のまま、SQL実行の準備をする
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':TUTOR', $_POST["TUTOR"], PDO::PARAM_STR); 
$stmt->bindParam(':id', $_POST["id"], PDO::PARAM_INT); 
$stmt->execute();

#メールを送るコード
$fromEmail = "taiga.k.5884@gmail.com";
$fromName = "The Tutors";
$mail = "taiga.k.5884@gmail.com"; $subject = "予約メール";
$body = "チューターが確定しました。ご確認ください。";
mb_send_mail($mail,$subject,$body);

redirect("update_page.php");




?>

