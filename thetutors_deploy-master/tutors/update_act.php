<?php

session_start();

include("funcs.php");

$day = $_POST["day"];
$start = $_POST["start"];
// $end = $_POST["end"];
$student_name = $_POST["STUDENT"];
$tutor_name = $_POST["TUTOR"];
$title = $_POST["title"];
$text = $_POST["text"];
$way = $_POST["way"];

// $student_email = $val["day"];
// $tutor_email = $val["day"];



$pdo = db_conn();

// データ更新
    // データ更新のSQL記述
    $sql = "UPDATE calendar_table SET TUTOR = :TUTOR WHERE id = :id";

    // 更新する値と該当のIDは空のまま、SQL実行の準備をする
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':TUTOR', $_POST["TUTOR"], PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
    $stmt->execute();


//メール自動送信

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


    //生徒メールアドレスを抽出するためのSQL
        // SQL記述
        // calendar_tableとtutors_user_tableを結合 ← calendar_tableだけでは生徒と講師のメールアドレスを抽出出来ないから
        $sql_student_mail = "SELECT * FROM calendar_table INNER JOIN tutors_user_table ON calendar_table.STUDENT = tutors_user_table.lid WHERE" ." '". $student_name ."' ". "= calendar_table.STUDENT";

        // SQL実行
        $stmt_student_mail = $pdo->prepare($sql_student_mail);
        $status_student_mail = $stmt_student_mail->execute();

        //データ表示
        if($status_student_mail==false) {
            sql_error();
        }else{
            $result_student_mail = $stmt_student_mail->fetch(PDO::FETCH_ASSOC);
        }


    // 講師メールアドレスを抽出するためのSQL
        //SQL記述
        $sql_tutor_mail = "SELECT * FROM calendar_table INNER JOIN tutors_user_table ON calendar_table.TUTOR = tutors_user_table.lid WHERE" ." '". $tutor_name ."' ". "= calendar_table.TUTOR";
        
        // SQL実行
        $stmt_tutor_mail = $pdo->prepare($sql_tutor_mail);
        $status_tutor_mail = $stmt_tutor_mail->execute();

        //データ表示
        if($status_tutor_mail==false) {
            sql_error();
        }else{
            $result_tutor_mail = $stmt_tutor_mail->fetch(PDO::FETCH_ASSOC);
        }



    // 生徒へのメール送信
        

        //件名の設定
        $student_reply_subject = '【The Tutors】マッチングが成立しました。質問の希望日程：' . $day ." | ". $start ."講師名：" . $tutor_name;

        // 本文を設定
        $student_reply_text = $student_name . "様\n\n";
        $student_reply_text .= "この度は、ご予約頂き誠にありがとうございます。\n下記の内容でマッチングが成立しましたので、ご連絡いたします。\n\n";
        $student_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
        $student_reply_text .= "マッチング成立日時：" . date("Y-m-d H:i") . "\n";
        $student_reply_text .= "講師名：" . $tutor_name . "\n";
        $student_reply_text .= "fb：" . $result_tutor_mail["fb"] . "\n";
        $student_reply_text .= "質問の希望日程：" . $day ." | ". $start . "\n";
        $student_reply_text .= "質問タイトル：" . $title . "\n";
        $student_reply_text .= "質問内容：" . $text . "\n";
        $student_reply_text .= "タイプ：" . $way . "\n";
        $student_reply_text .= "これからの流れ：" . "\n";
        $student_reply_text .= "１　上記のFacebookリンクから友達申請をしましょう。" . "\n";
        $student_reply_text .= "２　Messangerで挨拶をしましょう。（例：はじめまして。東京DEVの山田と言います。当日はよろしくお願いします！！）" . "\n";
        $student_reply_text .= "３　３分前になったらチューターがFacebookメッセンジャービデオチャットで部屋を用意して、リンクを送ってください。" . "\n";
        $student_reply_text .= "メッセンジャーの使い方（1:00〜）　　https://youtu.be/zlc8HW7JToU" . "\n";
        $student_reply_text .= "４ 時間になったら、生徒がルームに入る。（事前連絡なく１０分遅刻したら、終了。１週間の利用禁止）" . "\n";
        $student_reply_text .= "５　生徒側から自己紹介し、質問タイム（注意点を読んでください。）" . "\n";
        $student_reply_text .= "６　１時間経ったら、チューターが部屋を閉じてください。（質問が終わってないなどの場合、チューターがよければ延長可能とします。ただし延長はチューターポイントには加算されません。）" . "\n";
        $student_reply_text .= "７　下記の、アンケートに回答をお願いします。" . "\n";
        $student_reply_text .= "注意点" . "\n";
        $student_reply_text .= "・生徒は必ず顔を出してコミュニケーションを取りましょう" . "\n";
        $student_reply_text .= "・生徒は質問は事前にまとめてお互いの時間を無駄にしないようにしましょう" . "\n";
        $student_reply_text .= "・エディターなどは、画面共有をしましょう" . "\n";
        $student_reply_text .= "終了後のアンケートリンク：https://docs.google.com/forms/d/e/1FAIpQLScFyTTd33fpkZuWBb2NwPgiDBEgDD_jBLgKESDCtf1OLo-gVQ/viewform" . "\n";
        $student_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
        $student_reply_text .= "The Tutors 事務局";

        // 生徒へメール送信
        
        mb_send_mail( $result_student_mail["email"] , $student_reply_subject, $student_reply_text, $header);


    //講師へのメール送信    
        
        //件名の設定
        $tutor_reply_subject = '【The Tutors】マッチングが成立しました。　質問の希望日程：' . $day ." | ". $start ."講師名：" . $student_name;


        // 本文を設定
        $tutor_reply_text = $tutor_name . "様\n\n";
        $tutor_reply_text .= "下記の内容でマッチングが成立しましたので、ご連絡いたします。\n\n";
        $tutor_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
        $tutor_reply_text .= "マッチング成立日時：" . date("Y-m-d H:i") . "\n";
        $tutor_reply_text .= "生徒名：" . $student_name . "\n";
        $tutor_reply_text .= "fb：" . $result_student_mail["fb"] . "\n";
        $tutor_reply_text .= "質問の希望日程：" . $day ." | ". $start . "\n";
        $tutor_reply_text .= "質問タイトル：" . $title . "\n";
        $tutor_reply_text .= "質問内容：" . $text . "\n";
        $tutor_reply_text .= "タイプ：" . $way . "\n";
        $tutor_reply_text .= "これからの流れ：" . "\n";
        $tutor_reply_text .= "１　上記のFacebookリンクから友達申請をしましょう。" . "\n";
        $tutor_reply_text .= "２　Messangerで挨拶をしましょう。（例：はじめまして。東京DEVの山田と言います。当日はよろしくお願いします！！）" . "\n";
        $tutor_reply_text .= "３　３分前になったらチューターがFacebookメッセンジャービデオチャットで部屋を用意して、リンクを送ってください。" . "\n";
        $student_reply_text .= "メッセンジャーの使い方（1:00〜）　　https://youtu.be/zlc8HW7JToU" . "\n";
        $tutor_reply_text .= "４ 時間になったら、生徒がルームに入る。（事前連絡なく１０分遅刻したら、終了。１週間の利用禁止）" . "\n";
        $tutor_reply_text .= "５　生徒側から自己紹介し、質問タイム（注意点を読んでください。）" . "\n";
        $tutor_reply_text .= "６　１時間経ったら、チューターが部屋を閉じてください。（質問が終わってないなどの場合、チューターがよければ延長可能とします。ただし延長はチューターポイントには加算されません。）" . "\n";
        $tutor_reply_text .= "７　下記の、アンケートに回答をお願いします。" . "\n";
        $tutor_reply_text .= "注意点" . "\n";
        $tutor_reply_text .= "・生徒は必ず顔を出してコミュニケーションを取りましょう" . "\n";
        $tutor_reply_text .= "・生徒は質問は事前にまとめてお互いの時間を無駄にしないようにしましょう" . "\n";
        $tutor_reply_text .= "・エディターなどは、画面共有をしましょう" . "\n";
        $tutor_reply_text.= "終了後のアンケートリンク：https://docs.google.com/forms/d/e/1FAIpQLScXWQNsk9gHrLwHwfbR9uvd5WK_WBDbWppfzNNx3TdR5gkWCQ/viewform?usp=sf_link" . "\n";
        $tutor_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
        $tutor_reply_text .= "The Tutors 事務局";

        // 講師へメール送信
        mb_send_mail( $result_tutor_mail["email"] , $tutor_reply_subject, $tutor_reply_text, $header);

    //管理者へのメール送信
        // 件名を設定
        $admin_reply_subject = "【The Tutors】マッチングが完了しました";
        
        // 本文を設定
        $admin_reply_text = "下記の内容でマッチングを完了しました。\n\n";
        $admin_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
        $admin_reply_text .= "マッチング成立時刻：" . date("Y-m-d H:i") . "\n";
        $admin_reply_text .= "生徒名：" . $student_name . "\n";
        $admin_reply_text .= "生徒メールアドレス：" . $result_student_mail["email"] . "\n";
        $admin_reply_text .= "生徒fb：" . $result_student_mail["fb"] . "\n";
        $admin_reply_text .= "講師名：" . $tutor_name . "\n";
        $admin_reply_text .= "講師メールアドレス：" . $result_tutor_mail["email"] . "\n";
        $admin_reply_text .= "講師fb：" . $result_tutor_mail["fb"] . "\n";
        $admin_reply_text .= "質問の希望日程：" . $day ." | ". $start . "～". $end. "\n";
        $admin_reply_text .= "タイトル：" . $title . "\n";
        $admin_reply_text .= "詳細：" . $text . "\n";
        $admin_reply_text .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
        

        // 運営側へメール送信
        mb_send_mail( 'thetutors777@gmail.com', $admin_reply_subject, $admin_reply_text, $header);


        // $fromEmail = "arusu.m3@gmail.com";
        // $fromName = "The Tutors";
        // $mail = "arusu.m3@gmail.com"; 
        // $subject = "予約メール";
        // $body = "チューターが確定しました。ご確認ください。";
        // mb_send_mail($mail,$subject,$body);
        redirect("update_page.php");
    ?>
