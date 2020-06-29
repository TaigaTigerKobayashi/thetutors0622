<?php
session_start();

include("../../tutors/funcs.php");

$day = $_POST["day"];
$title = $_POST["textTitle"];
$start = $_POST["start"];
// $end = $_POST["end"];
$text = $_POST["text"];
$color = $_POST["color"];
$id = $_SESSION["id"];
// 以下追加
$name = $_SESSION["lid"];
$email = $_SESSION["email"];
$fb = $_SESSION["fb"];


$pdo = db_conn();

$sql = "INSERT INTO calendar_table(STUDENT,title,text,color,day,start)VALUES(:lid,:title,:text,:color,:day,:start)";
$stmt = $pdo-> prepare($sql);
$stmt -> bindValue(':lid',$_SESSION["lid"],PDO::PARAM_STR);
$stmt -> bindValue(':title',$title,PDO::PARAM_STR);
$stmt -> bindValue(':text',$text,PDO::PARAM_STR);
$stmt -> bindValue(':color',$color,PDO::PARAM_STR);
$stmt -> bindValue(':day',$day,PDO::PARAM_STR);
$stmt -> bindValue(':start',$start,PDO::PARAM_STR);
// $stmt -> bindValue(':end',$end,PDO::PARAM_STR);
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
    $header .= "From: The Tutors <thetutors777@gmail.com>\n";
    $header .= "Reply-To: The Tutors <thetutors777@gmail.com>\n";

    // 生徒側へ送るメールの件名

        // 件名を設定
        $auto_reply_subject = '【The Tutors】ご予約ありがとうございます。';
        
        // 本文を設定
        $auto_reply_text = $name . "様\n\n";
        $auto_reply_text .= "この度は、ご予約頂き誠にありがとうございます。\n下記の内容でご予約を受け付けました。\n\n";
        $auto_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
        $auto_reply_text .= "ご予約日時：" . date("Y-m-d H:i") . "\n";
        $auto_reply_text .= "質問の希望日程：" . $day ." | ". $start . "\n";
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
        $admin_reply_text .= "質問の希望日程：" . $day ." | ". $start . "\n";
        $admin_reply_text .= "タイトル：" . $title . "\n";
        $admin_reply_text .= "詳細：" . $text . "\n";
        $admin_reply_text .= "氏名：" . $name . "\n";
        $admin_reply_text .= "メールアドレス：" . $email . "\n";
	$admin_reply_text .= "fb：" . $fb . "\n";
        $auto_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";

        // 運営側へメール送信
        mb_send_mail( 'thetutors777@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
  
}

if ($status == false) {
    sql_error($stmt);
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    html{
        height:100%;
    }

    body{
        height:100%;
        margin:0;
    }

    .box{
        height:60%;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    p{
        font-weight:bold;
        padding:0;
        margin:0;
        font-size:20px;
    }
    </style>
</head>
<body>
    <a href="cal.php"><button type="button" class="btn btn-info">reserve</button></a>
    <a href="cal_tutor.php"><button type="button" class="btn btn-success">tutor</button></a>
    <a href="../../tutors/logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
    <p>予約が完了しました。</p>
    <p>マッチング完了メールが迷惑メールに入ってしまう場合があります。</p>
    <p>この後、予約確認メールが届きますので、迷惑メールに入っていないかご確認お願いします。</p>

</body>
</html>
