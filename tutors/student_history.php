<?php
session_start();
include('funcs.php');//別の階層にfuncs.phpがある場合は「betukaisou/funcs.php」などパスを変えてincludesする
// $sid =$_GET['STUDENT'];
// $tid =$_GET['TUTOR'];
if(isset($_GET['STUDENT'])){
  $sid =$_GET['STUDENT'];
  $pdo = db_conn();

  //２．データ登録SQL作成
  $stmt = $pdo->prepare("SELECT * FROM calendar_table WHERE STUDENT = '$sid' OR TUTOR = '$sid' ORDER BY id DESC");
}else if(isset($_GET['TUTOR'])){
  $tid =$_GET['TUTOR'];
 //1. DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM calendar_table WHERE STUDENT = '$tid' OR TUTOR = '$tid' ORDER BY id DESC");
}else{
  echo '何もこなかった';
}
// echo $sid;
// echo $tid;

// //1. DB接続します
// $pdo = db_conn();

// //２．データ登録SQL作成
// $stmt = $pdo->prepare("SELECT * FROM calendar_table WHERE STUDENT = '$sid' OR TUTOR = '$sid' ORDER BY id DESC");
$status = $stmt->execute();


//3．データ登録処理後（基本コピペ使用でOK)
$view='';
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
 //selectデータの数だけ自動でループしてくれる
 $view='';
 while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
  $view .='<p>';
  $view .=$r["day"].":".$r["start"]."~".$r["end"].'<br>';
  $view .='言語 : 「'.$r["title"]."」 概要:".$r["text"].'<br>';
  $view .='受講生徒は : 「'.$r["STUDENT"]."」 さんです。".'<br>';
  $view .='担当講師は : 「'.$r["TUTOR"]."」 さんです。".'<br>';
  $view .='</p>';

 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
</head>
<body>
<?php include('kanriHeader.php'); ?>
  <h1><?php echo $sid ?> <?php echo $tid ?> さんの予約履歴</h1>
  <a href="student_list.php">ユーザー一覧へ戻る</a>

 <p><?=$view?></p>
</body>
</html>