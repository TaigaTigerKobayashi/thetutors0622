<?php
// var_dump($_POST);

// 変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm']) ) {

	$page_flag = 1;
} elseif( !empty($_POST['btn_submit']) ) {

    $page_flag = 2;
    // 問い合わせたお客様へのメール
        // 変数とタイムゾーンを初期化
        $header = null;
        $auto_reply_subject = null;
        $auto_reply_text = null;
        $admin_reply_subject = null;
        $admin_reply_text = null;
        date_default_timezone_set('Asia/Tokyo');

        // ヘッダー情報を設定
        $header = "MIME-Version: 1.0\n";
        $header .= "From: TheTutors <arusu.m3@gmail.com>\n";
        $header .= "Reply-To: TheTutors <arusu.m3@gmail.com>\n";

        // 件名を設定
        $auto_reply_subject = 'お問い合わせありがとうございます。';

        // 本文を設定
        $auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
    下記の内容でお問い合わせを受け付けました。\n\n";
        $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
        $auto_reply_text .= "氏名：" . $_POST['name'] . "\n";
        $auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n";
        $auto_reply_text .= "ご用件：" . $_POST['subjec'] . "\n";
        $auto_reply_text .= "内容：" . $_POST['message'] . "\n\n";
        $auto_reply_text .= "TheTutors 事務局";

        // メール送信
        mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);

	// 運営側へ送るメールの件名
        $admin_reply_subject = "お問い合わせを受け付けました";
        
        // 本文を設定
        $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
        $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
        $admin_reply_text .= "氏名：" . $_POST['name'] . "\n";
        $admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n";
        $admin_reply_text .= "ご用件：" . $_POST['subjec'] . "\n";
        $admin_reply_text .= "内容：" . $_POST['message'] . "\n\n";
    

        // 運営側へメール送信
        mb_send_mail( 'arusu.m3@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
    
}
?>


<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- Font Awesome -->
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>
<body style="margin: 0 10px;">
<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">お問い合わせ</h2>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">


        <?php if( $page_flag === 1 ): ?>


        <!-- 確認画面 -->
        <form id="contact-form" name="contact-form" action="" method="POST">

            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <label for="name" class="" style="font-weight:bold;">お名前</label>
                        <p><?php echo $_POST['name']?></p>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <label for="email" class="" style="font-weight:bold;">メールアドレス</label>
                        <p><?php echo $_POST['email']?></p>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <label for="subject" class="" style="font-weight:bold;">ご用件</label>
                        <p><?php echo $_POST['subject']?></p>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <label for="message" style="font-weight:bold;">内容</label>
                        <p><?php echo $_POST['message']?></p>
                    </div>

                </div>
            </div>
            <!--Grid row-->

            <div class="text-center text-md-left" style="display:flex;justify-content:center;">
                <input type="submit" name="btn_back" value="戻る">
                <input class="btn btn-primary" type="submit" name="btn_submit" value="送信" style="color:white;"></input>
            </div>
            <div class="status"></div>

            <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
            <input type="hidden" name="subject" value="<?php echo $_POST['subject']; ?>">
            <input type="hidden" name="message" value="<?php echo $_POST['message']; ?>">


            </form>

        <?php elseif( $page_flag === 2 ): ?>
        
        <!-- 送信完了画面 -->
        <p>送信が完了しました。</p>

        <?php else: ?>


        <!-- 入力画面 -->
            <form id="contact-form" name="contact-form" action="" method="POST">

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="name" class="" style="font-weight:bold;">お名前</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="email" class="" style="font-weight:bold;">メールアドレス</label>
                            <input type="text" id="email" name="email" class="form-control" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="" style="font-weight:bold;">ご用件</label>
                            <input type="text" id="subject" name="subject" class="form-control" value="<?php if( !empty($_POST['subject']) ){ echo $_POST['subject']; } ?>">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="message" style="font-weight:bold;">内容</label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"><?php if( !empty($_POST['message']) ){ echo $_POST['message']; } ?></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

                <div class="text-center text-md-left" style="display:flex;justify-content:center;">
                    <input class="btn btn-primary" type="submit" name="btn_confirm" value="入力内容を確認する" style="color:white;"></input>
                </div>
                <div class="status"></div>

            </form>

        <?php endif; ?>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>G's ACADEMY TOKYO BASE：〒107-0061 東京都港区北青山3-5-6 青朋ビル2F</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>000 - 0000 - 0000</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>contact@thetutors.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
<!--Section: Contact v.2-->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
