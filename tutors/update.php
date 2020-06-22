<?php 
include('funcs.php');



//1. POSTデータ取得
$id = $_POST['id'];
$STUDENT = $_POST['STUDENT'];
$TUTOR = $_POST['TUTOR'];
$title = $_POST['title'];
$text = $_POST['text'];
$day = $_POST['day'];
$start = $_POST['start'];
$end = $_POST['end'];




//2. DB接続します(insert.phpをまるコピのままでOK)
$pdo = db_conn();



//３．データ登録SQL作成
//3-1: sql作る処理(追記部分)
//更新の基本の書き方：UPDATE テーブル名 SET 変更データ WHERE 選択データ;
$sql = 'UPDATE calendar_table SET STUDENT=:STUDENT,TUTOR=:TUTOR,title=:title,text=:text,day=:day,start=:start,end=:end WHERE id=:id';
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ

//3-2: sql文をstmtに渡す処理
$stmt = $pdo->prepare($sql);

//3-3: 関連付けをして、STUDENTやemailを3-1の同じ文字に紐付ける(ここはinsert.phpから修正している)
$stmt->bindValue(':STUDENT',   $STUDENT,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)  第３引数は省略出来るが、セキュリティの観点から記述している。文字列か数値はmysqlのデータベースに登録したものがvarcharaかintかというところで判断する
$stmt->bindValue(':TUTOR', $TUTOR, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title',    $title,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':day', $day, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':start', $start, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':end', $end, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//3-4: 最後に実行する
$status = $stmt->execute();//このexecuteで上で処理した内容を実行している



//４．データ登録処理後（基本コピペ使用でOK)
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{//この項目以下の遷移先のみ変更↓
  //５．select2.phpへリダイレクト(エラーがなければindex.phpt)
  header('Location: student_list.php');//Location:の後ろの半角スペースは必ず入れる。
  exit;
//このupdate.phpが表示されるのはエラーの時のみ。更新が順調に完了した場合select2.phpへ移動する
}
?>
