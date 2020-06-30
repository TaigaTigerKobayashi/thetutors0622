<?php
session_start();
// $id = $_GET["id"]; //誰がログインしてきたのか→必要ない
include("funcs.php");
$pdo = db_conn();
//２．データ登録SQL作成
// とにかくこのページに来たら未設定の予約一覧が表示されるようにしたい＝TUTOR==null
$stmt = $pdo->prepare("SELECT * FROM calendar_table WHERE TUTOR IS NULL");
// $stmt->bindValue(":id",$id,PDO::PARAM_INT); nullはとってきた値ではないので。
$status = $stmt->execute();
//３．データ表示
if($status==false) {
    sql_error();
}else{
    $result = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<!-- Head[Start] -->
<?php include("menu.php"); ?>
<!-- Head[End] -->
<!-- チューターが割り振られていない予約を全て出力 -->
<!-- Main[Start] -->
<?php
foreach($result as $row){
?>
  <form method="POST" action="update_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>編集</legend>
     <label>STUDENT：<input type="text" name="STUDENT" value="<?=$row["STUDENT"]?>"></label><br>
     <label>質問日：<input type="text" name="day" value="<?=$row["day"]?>"></label><br>
     <label>開始時刻：<input type="text" name="start" value="<?=$row["start"]?>"></label><br>
     <!-- <label>終了時刻：<input type="text" name="end" value="<?=$row["end"]?>"></label><br> -->
     <label>TUTOR：<input type="text" name="TUTOR" value="<?=$row["TUTOR"]?>"></label><br>
     <label>質問タイトル：<input type="text" name="title" value="<?=$row["title"]?>"></label><br>
     <label>質問内容：<textArea name="text" rows="4" cols="40"><?=$row["text"]?></textArea></label><br>
     <input type="submit" value="送信" name="submit">
     <input type="hidden" name="id" value="<?=$row["id"]?>">
    </fieldset>
  </div>
</form>
<?php
}
?>
<!-- Main[End] -->
</body>
</html>
