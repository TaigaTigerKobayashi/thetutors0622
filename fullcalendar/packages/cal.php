<?php 
session_start();

include("../../tutors/funcs.php");
sschk();

$page_flg = 0;

if(!empty($_POST['add'])){
  $page_flg = 1;
}

$pdo = db_conn();

$stmt = $pdo -> prepare("SELECT * FROM calendar_table WHERE STUDENT=:lid");
$stmt->bindValue(':lid',$_SESSION["lid"], PDO::PARAM_STR);
$status = $stmt -> execute();

// var_dump($_POST);





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

  <style>
    label {
      display: inline-block;
      margin-bottom: 10px;
      font-weight: bold;
      width: 150px;
    }

    .list-group-item{
      display:inline-block;
    }

    .list-group-item li{
      display: inline-block;
      margin:  0;
      text-align: left;
    }

    #exampleFormControlTextarea1{
      display:none!important;
    }

  </style>
</head>

<body>
  <a href="../../tutors/point.php">ポイント確認画面</a>
  <?php if($page_flg === 1):?>
    <div class="container w-50">
    
      <form method="post" action="ca_insert.php">
        <ul class="list-group list-group-flush">
          <div class="list-group-item pt-3 pb-3">
            <label>日付</label>
            <li><?= $_POST["day"]?></li>
          </div>

          <div class="list-group-item pt-3 pb-3">
            <label>質問タイトル</label>
            <li><?= $_POST["textTitle"]?></li>
          </div>

          <div class="list-group-item pt-3 pb-3">
            <label>開始時間</label>
            <li><?= $_POST["start"]?></li>
          </div>

          <div class="list-group-item pt-3 pb-3">
            <label>終了時間</label>
            <li><?= $_POST["end"]?></li>
          </div>

          <div class="list-group-item pt-3 pb-3">
            <label>質問内容</label>
            <li><?= $_POST["text"]?></li>
          </div>
        </ul>
        <input class="btn btn-success" type="submit" name="btn_submit" value="予約する">
        <div class="form-group">
          <input type="hidden" name="day" class="form-control" id="exampleFormControlInput1" value="<?= $_POST["day"]?>">
        </div>

        <div class="form-group">
          <input type="hidden" name="textTitle" class="form-control" id="exampleFormControlInput2" value="<?= $_POST["textTitle"]?>">
        </div>

        <div class="form-group">
          
          <input type="hidden" name="start" class="form-control" id="exampleFormControlInput3" value="<?= $_POST["start"]?>">
        </div>

        <div class="form-group">
          <input type="hidden" name="end" class="form-control" id="exampleFormControlInput4" value="<?= $_POST["end"]?>">
        </div>

        <div class="form-group">
          <textarea type="hidden" name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $_POST["text"]?></textarea>
        </div>

        <div class="form-group">
          <input type="hidden" name="color" class="form-control" id="exampleFormControlInput5" value="<?= $_POST["color"]?>">
        </div>
  
  
      </form>
    </div>
  <?php elseif($page_flg === 2):?>
    
  <?php else: ?>
  <div class="container">
    <a href="../../tutors/logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
    <a href="cal_tutor.php"><button type="button" class="btn btn-success">tutor</button></a>
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
        <form action="" method="post" class="container">
          <div class="modal-body">
            <!-- ↓ここにモーダルの説明部分が表示される -->
            <!-- ID: <input type="text" id='txtId' name='txtId'><br> -->

            <!-- 日付: <input type="text" id="txtDay" name="day"><br>
            タイトル: <input type="text" id="txtTitle" name="textTitle"><br>
            開始時間: <input type="text" id="start" name="start" value="18:00"><br>
            終了時間: <input type="text" id="end" name="end"><br>
            詳細: <textarea id="txtDescription" name="text" rows="3"></textarea><br>
            色: <input type="color" id="txtColor" name="color" value="#ff0000"><br> -->

              <div class="form-group">
                <label for="txtDay">日付</label>
                <input type="text" class="form-control" id="txtDay" name="day">
              </div>
              <div class="form-group">
                <label for="txtTitle">言語</label>
                <input type="text" class="form-control" id="txtTitle" name="textTitle">
              </div>
              <div class="form-group">
                <label for="start">開始時間</label>
                <select class="form-control" id="start" name="start">
                  <option>18:00</option>
                  <option>19:00</option>
                  <option>20:00</option>
                  <option>21:00</option>
                  <option>22:00</option>
                </select>
              </div>
              <div class="form-group">
                <label for="end">終了時間</label>
                <select class="form-control" id="end" name="end">
                  <option>19:00</option>
                  <option>20:00</option>
                  <option>21:00</option>
                  <option>22:00</option>
                </select>
              </div>
              <div class="form-group">
                <label for="text">詳細</label>
                <textarea class="form-control" id="text" rows="3" name="text"></textarea>
              </div>

              <div class="form-group">
                <label for="txtTitle">色</label>
                <input type="color" class="form-control" id="color" name="color">
              </div>

          </div>
          <div class="modal-footer">
            <input type="submit" id="btnAdd" class="btn btn-success" name="add" value="入力内容を確認する">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- モーダルここまで -->
  <?php endif; ?>




  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
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
          <?php if($page_flg === 1):?>

          <?php else:?>
          <?php while($r = $stmt -> fetch(PDO::FETCH_ASSOC)){?>
          {
            title: '<?= $r["title"]?>',
            descripcion: '<?= $r["text"]?>',
            start: '<?= $r["day"].'T'.$r["start"] ?>',
            end: '<?= $r["day"].'T'.$r["end"] ?>',
            //ここに記述すると個別に色を設定可能
            color: '<?= $r["color"]?>',
            textColor: 'gray'
            }, <?php } ?>
          <?php endif;?>


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