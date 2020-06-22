<?php
session_start();
include('funcs.php');


//1.GETでidを取得
$id =$_GET['id'];



//2. DB接続します(ここコピペでOK。select2.phpの時と記載同じ)
$pdo = db_conn();



//3．データ登録SQL作成(今回はselect2.phpの一覧表示から1行だけ取り出す記述をする)
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$sql = "SELECT * FROM calendar_table WHERE id=:id";//この1行select2.phpから修正
$stmt = $pdo->prepare($sql);//select2.phpで元々あった()内の記述を修正し、変数sqlへ格納したものを（）内に記述
$stmt->bindValue('id', $id, PDO::PARAM_INT);//ここの記述はselect2.phpにない部分！
$status = $stmt->execute();


//4．データ登録処理後（elseより手前はselect2.phpと同じ）
$view='';
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{//ここより下は修正している↓
 //1データのみ抽出の為,select2.phpであったwhile文を削除。ここで$rowを定義
$row = $stmt->fetch();
}

//以下のhtmlタグ内の記述は見た目のレイアウトを合わせると良いため、基本index2.phpをコピペする。
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>登録情報の更新画面</title>

</head>
<body>
<?php include('kanriHeader.php'); ?>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    </div>
  </nav>
</header>
<!-- Head[End] -->
<p><a href="student_list.php">ユーザー一覧へ戻る</a></p>

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>予約情報</legend>
     <label>日にち<input type="text" name="day" value="<?=$row["day"]?>"></label><br>
     <label>開始時間<input type="text" name="start" value="<?=$row["start"]?>"></label><br>
     <label>終了時間<input type="text" name="end" value="<?=$row["end"]?>"></label><br>
     <label>受講生徒<input type="text" name="STUDENT" value="<?=$row["STUDENT"]?>"></label><br>
     <label>担当講師<input type="text" name="TUTOR" value="<?=$row["TUTOR"]?>"></label><br>
     <label>予約言語<input type="text" name="title" value="<?=$row["title"]?>"></label><br>
     <p>学習内容詳細</p>
     <label><textArea name="text" rows="4" cols="40"><?=$row["text"]?></textArea></label><br>
     <input type="hidden" name='id' value="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

