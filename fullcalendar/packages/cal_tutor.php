<?php 
session_start();

include("../../tutors/funcs.php");

$pdo = db_conn();

$stmt = $pdo -> prepare("SELECT * FROM calendar_table WHERE TUTOR=:lid");
$stmt->bindValue(':lid',$_SESSION["lid"], PDO::PARAM_STR);
$status = $stmt -> execute();





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="core/main.css">
  <link href='daygrid/main.css' rel='stylesheet' />
  <link href='timegrid/main.css' rel='stylesheet' />
</head>

<body>
  <div class="container">
  <a href="../../tutors/logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
  <a href="cal.php"><button type="button" class="btn btn-info">reserve</button></a>
    <div class="row">
      <div class="col"></div>
      <div class="col-7">
        <div id="calendar"></div>
      </div>
      <div class="col"></div>
    </div>
  </div>

  <!-- モーダル -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titleEvent"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="ca_insert.php" method="post">
          <div class="modal-body">
            <!-- ↓ここにモーダルの説明部分が表示される -->
            <!-- ID: <input type="text" id='txtId' name='txtId'><br> -->
  
            日付: <input type="text" id="txtDay" name="day"><br>
            タイトル: <input type="text" id="txtTitle" name="textTitle"><br>
            開始時間: <input type="text" id="txtTime" name="start" value="18:00"><br>
            終了時間: <input type="text" name="end"><br>
            詳細: <textarea id="txtDescription" name="text" rows="3"></textarea><br>
            色: <input type="color" id="txtColor" name="color" value="#ff0000"><br>
  
          </div>
          <div class="modal-footer">
            <input type="submit" id="btnAdd" class="btn btn-success" value="入力内容を確認する">
            <button type="button" class="btn btn-success">修正</button>
            <button type="button" class="btn btn-danger">削除</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- モーダルここまで -->




  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src='core/main.js'></script>
  <script src='daygrid/main.js'></script>
  <script src='interaction/main.js'></script>
  <script src='timegrid/main.js'></script>
  <script src="core/locales-all.js"></script>



  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid'],
        header: { //ヘッダー選択
          left: 'today ,prev,next, testbtn',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: 'ja', //日本語選択
        businessHours: true, //土日を色付け
        eventTimeFormat: {
          hour: 'numeric',
          minute: '2-digit'
        }, //時間の表記を12時→12:00に

        // navLinks: true, // can click day/week names to navigate views
        selectable: true, //日付のクリックを可能に
        selectMirror: true, //クリック関係（詳細不明）

        //日付をクリックした時の記述
        dateClick: function (info) {
          // alert('Date: ' + info.dateStr);
          $('#txtDay').val(info.dateStr);
          $('#exampleModal').modal();


        },




        events: [ //ここに記入してイベントを作る

        //ここでデータベースの内容を繰り返しで表示
        <?php while($r = $stmt -> fetch(PDO::FETCH_ASSOC)){ ?>
          {
            title: '<?= $r["title"]?>',
            descripcion: '<?= $r["text"]?>',
            start: '<?= $r["day"].'T'.$r["start"] ?>',
            end: '<?= $r["day"].'T'.$r["end"] ?>',
            //ここに記述すると個別に色を設定可能
            color: '<?= $r["color"]?>',
            textColor: 'gray'
          },
        <?php }?>


          // {
          //   title: 'サイト制作',
          //   descripcion: '選手権制作スタート〜エンド',
          //   start: '2020-06-17T12:30:00',
          //   end: '2020-06-23T12:30:00'
          // },
          // {
          //   title: 'プレリリース 発表会',
          //   descripcion: '発表会',
          //   start: '2020-06-24T12:30:00',
          //   allDay: false, //ここのfalseだと終日の部分に表示されなくなる
          //   color: 'black',
          //   textColor: 'pink'
          // }

        ],

        //イベントバーにクリックした時の記述
        eventClick: function (info) {
          alert('Event: ' + info.event.title);



        }




      });

      //追加ボタンを押した時の記述////////////////////////////////////
      // let btnAdd = document.querySelector('#btnAdd');
      // btnAdd.addEventListener('click', function () {
      //     alert('Hit');
      //     let newEvent = {
      //       title: $('#txtTitle').val(),
      //       descripcion: $('#txtDescription').val(), //モーダル２のテキストエリアに記載の値になる
      //       start: $('#txtDay').val() + "" + 'T' + $('#txtTime').val(),
      //       color: $('#txtColor').val(),
      //       textcolor: '#FFFFFF'
      //     };
      //     console.log(newEvent);


      //     calendar.addEvent({
      //       title: $('#txtTitle').val(),
      //       descripcion: $('#txtDescription').val(), //モーダル２のテキストエリアに記載の値になる
      //       start: $('#txtDay').val() + "" + 'T' + $('#txtTime').val(),
      //       color: $('#txtColor').val(),
      //       // textcolor:'F0F0F0'
      //       // allDay: true
      //     });
      //     $('#exampleModal').modal('toggle'); //モーダルの表示を切り替える（つまり消える）


      //   }),
        //追加ボタンを押した時の記述ここまで////////////////////////////////////


        calendar.render();
    });
  </script>
</body>

</html>