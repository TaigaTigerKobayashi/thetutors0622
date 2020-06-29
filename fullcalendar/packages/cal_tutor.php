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
  <style>
    html{
      height:100%;
    }

    body{
      height:100%;
    }


    *{
      box-sizing:border-box;
    }
    .fc-content{
      cursor:pointer;
    }

    .modal-body{
      padding:0;
    }

    label {
      margin:0;
      font-weight: bold;
      width: 150px;
    }

    .list-group-item{
      display:flex;
      align-items:center;
      padding:15px 5px;
    }

    .list-group-item li{
      width:70%;
      margin:  0;
      text-align: left;
      list-style:none;
    }
  </style>
</head>

<body>
  <div class="container h-100">
  <a href="../../tutors/logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
  <a href="cal.php"><button type="button" class="btn btn-info">reserve</button></a>
    <div class="row h-75 d-flex align-items-center">
      <div class="col"></div>
      <div class="col-7 ">
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
        <form>
          <div class="modal-body">
            <!-- ↓ここにモーダルの説明部分が表示される -->
            <!-- ID: <input type="text" id='txtId' name='txtId'><br> -->
            <ul class="list-group list-group-flush">

              <div class="list-group-item">
                <label class="text-center">生徒</label>
                <li id="student_name" class="m-auto"></li>
              </div>

              <div class="list-group-item">
                <label class="text-center">言語</label>
                <li id="txtTitle" class="m-auto"></li>
              </div>

              <div class="list-group-item">
                <label class="text-center">開始時間</label>
                <li id="start" class="m-auto"></li>
              </div>

              <div class="list-group-item">
                <label class="text-center">質問内容</label>
                <li id="txtDescription" class="m-auto"></li>
              </div>
            </ul> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">閉じる</button>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js" type="text/javascript"></script>
  <script src='core/main.js'></script>
  <script src='daygrid/main.js'></script>
  <script src='interaction/main.js'></script>
  <script src='timegrid/main.js'></script>
  <script src="list/main.js"></script>
  <script src="core/locales-all.js"></script>
  <script src="bootstrap/main.js"></script>



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
        timeZone: 'Asia/Tokyo',
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
        // dateClick: function (info) {
        //   // alert('Date: ' + info.dateStr);
        //   $('#txtDay').val(info.dateStr);
        //   $('#exampleModal').modal();


        // },




        events: [ //ここに記入してイベントを作る

        //ここでデータベースの内容を繰り返しで表示
        <?php while($r = $stmt -> fetch(PDO::FETCH_ASSOC)){ ?>
          {
            name:'<?=$r["STUDENT"]?>',
            title: '<?= $r["title"]?>',
            descripcion: '<?=  preg_replace('/[\x00-\x1F\x7F]/','',$r["text"])?>',
            start: '<?= $r["day"].'T'.$r["start"] ?>',
            // end:
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
          $('#student_name').text(info.event.extendedProps.name + 'さん');
          $('#txtTitle').text(info.event.title);
          $('#start').text(moment.utc(info.event.start).format("HH:mm"));
          // $('#end').text(moment.utc(info.event.end).format("HH:mm"));
          $('#txtDescription').text(info.event.extendedProps.descripcion);
          $('#exampleModal').modal();

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
