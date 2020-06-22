<?php
session_start();
include("funcs.php");
$pdo = db_conn();

$sql = "SELECT TUTOR,COUNT(TUTOR) AS COUNT FROM CALENDAR_TABLE GROUP BY TUTOR ORDER BY COUNT DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<P>';
        $view .= $result["TUTOR"] . ":" . $result["COUNT"];;
        $view .= '　';
        $view .= '</p>';
    }
}
$php_array = array();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($php_array,$result["COUNT"]);
};
$php_json = json_encode($php_array);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ポイント表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <h1> G's TOKYO && Fukuoka Tutor Point</h1>
    <div class="container p-3 mb-2 bg-success text-white"><?php echo $view; ?></div>
</div>

<form class="form-signin" method="POST" action="../fullcalendar/packages/cal.php">
    <button class="btn btn-lg btn-primary btn-block" type="submit">予約画面に戻る</button>
    <div class="link-area">
    </div>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
  </form>
<!-- Main[End] -->
  <canvas id="myBarChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

  <script>
  var ctx = document.getElementById("myBarChart");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['半田', '古謝', '山桝', ],
      datasets: [
        {
          label: 'チューター回数',
          data: [3,2,1],
          backgroundColor: "rgba(219,39,91,0.5)"
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'チューターポイントランキング'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 20,
            suggestedMin: 0,
            stepSize: 5,
            callback: function(value, index, values){
              return  value +  '人'
            }
          }
        }]
      },
    }
  });
  </script>
</body>
</html>
