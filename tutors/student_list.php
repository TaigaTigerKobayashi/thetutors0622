<?php
session_start();

//1.外部ファイル読み込み＆DB接続
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
// sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM calendar_table ORDER BY id DESC");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
         //更新用リンクを埋め込んだ表示コード(元のselect.phpから修正する箇所)
  $view .='<p>';
  // $view .='<a href="u_view.php? id='.$r["id"].'">';
  $view .=$r["day"]."&nbsp;/&nbsp;".$r["start"]."~".$r["end"].'<br>';
  $view .='言語 : 「'.$r["title"]."」 概要:".$r["text"].'<br>';
  $view .='<a href="student_history.php? STUDENT='.$r["STUDENT"].'">'.'生徒'.'</a> : '.$r["STUDENT"].' / '.'<a href="student_history.php? TUTOR='.$r["TUTOR"].'">'.'講師'.'</a> : '.$r["TUTOR"].'<br>';

  // $view .='</>';
//以下はupdateのリンクタグの記述
  $view .='  ';
  $view .='<a href="u_view.php? id='.$r["id"].'">';
  $view .='[更新]';
  $view .='</a>';
//以下はdeleteのリンクタグの記述
  $view .='  ';
  $view .='<a href="delete.php? id='.$r["id"].'">';
  $view .='[削除]';
  $view .='</a>';
  $view .='</p>';
    }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>USER表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<?php include('kanriHeader.php'); ?>

<!-- Head[Start] -->
<header>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <h1> ユーザー一覧</h1>
    <div class="container jumbotron"><?php echo $view; ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
