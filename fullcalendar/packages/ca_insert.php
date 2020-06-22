<?php
session_start();

include("../../tutors/funcs.php");

$day = $_POST["day"];
$title = $_POST["textTitle"];
$start = $_POST["start"];
$end = $_POST["end"];
$text = $_POST["text"];
$color = $_POST["color"];
$id = $_SESSION["id"];
// 以下追加
$name = $_SESSION["lid"];
$email = $_SESSION["email"];


$pdo = db_conn();

$sql = "INSERT INTO calendar_table(STUDENT,title,text,color,day,start,end)VALUES(:lid,:title,:text,:color,:day,:start,:end)";
$stmt = $pdo-> prepare($sql);
$stmt -> bindValue(':lid',$_SESSION["lid"],PDO::PARAM_STR);
$stmt -> bindValue(':title',$title,PDO::PARAM_STR);
$stmt -> bindValue(':text',$text,PDO::PARAM_STR);
$stmt -> bindValue(':color',$color,PDO::PARAM_STR);
$stmt -> bindValue(':day',$day,PDO::PARAM_STR);
$stmt -> bindValue(':start',$start,PDO::PARAM_STR);
$stmt -> bindValue(':end',$end,PDO::PARAM_STR);
$status = $stmt -> execute();


// cal.phpで予約追加ボタンが押されたときの処理
  //講師と生徒のマッチング後の自動メール送信
  if( !empty($_POST['add']) ){

    // 変数とタイムゾーンを初期化
    $header = null;
	$auto_reply_subject = null;
	$auto_reply_text = null;
	$admin_reply_subject = null;
	$admin_reply_text = null;
    date_default_timezone_set('Asia/Tokyo');

    // ヘッダー情報を設定
    $header = "MIME-Version: 1.0\n";
    $header .= "From: The Tutors <arusu.m3@gmail.com>\n";
    $header .= "Reply-To: The Tutors <arusu.m3@gmail.com>\n";

    // 生徒側へ送るメールの件名

        // 件名を設定
        $auto_reply_subject = '【The Tutors】ご予約ありがとうございます。';
        
        // 本文を設定
        $auto_reply_text = $name . "様\n\n";
        $auto_reply_text .= "この度は、ご予約頂き誠にありがとうございます。\n下記の内容でご予約を受け付けました。\n\n";
        $auto_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
        $auto_reply_text .= "ご予約日時：" . date("Y-m-d H:i") . "\n";
        $auto_reply_text .= "質問の希望日程：" . $day ." | ". $start . "～". $end. "\n";
        $auto_reply_text .= "質問タイトル：" . $title . "\n";
        $auto_reply_text .= "質問内容：" . $text . "\n";
        $auto_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
        $auto_reply_text .= "The Tutors 事務局";

        // メール送信
        mb_send_mail( $email, $auto_reply_subject, $auto_reply_text, $header);


    // 運営側へ送るメールの件名
        // 件名を設定
        $admin_reply_subject = "【The Tutors】ご予約を受け付けました";
        
        // 本文を設定
        $admin_reply_text = $name . "様より下記の内容でご予約がありました。\n\n";
        $admin_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
        $admin_reply_text .= "ご予約日時：" . date("Y-m-d H:i") . "\n";
        $admin_reply_text .= "質問の希望日程：" . $day ." | ". $start . "～". $end. "\n";
        $admin_reply_text .= "タイトル：" . $title . "\n";
        $admin_reply_text .= "詳細：" . $text . "\n";
        $admin_reply_text .= "氏名：" . $name . "\n";
        $admin_reply_text .= "メールアドレス：" . $email . "\n";
        $auto_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";

        // 運営側へメール送信
        mb_send_mail( 'arusu.m3@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
  
}

if ($status == false) {
    sql_error($stmt);
} else {
    //５．index.phpへリダイレクト
    redirect("cal.php");
}


?>
