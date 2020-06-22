<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="generator" content="">
  <title>ログイン画面</title>


  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <style>

    .modal-dialog{
      display: flex;
      flex-direction: column;
      justify-content: center;
      min-height: 100%;
      margin: auto;
      pointer-events: none;
    }
  </style>
</head>

<body class="text-center">
  <form class="form-signin" method="POST" action="login_act.php">
    <h1 class="h3 mb-3 font-weight-normal">ログイン</h1>
    <label for="inputUserID" class="sr-only">ユーザーID</label>
    <input type="text" name="lid" id="inputUserID" class="form-control mb-3" placeholder="ユーザーID" required autofocus>
    <label for="inputPassword" class="sr-only">パスワード</label>
    <input type="password" name="lpw" id="inputPassword" class="form-control" placeholder="パスワード" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> ログイン状態を保持する
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
    <div class="link-area">
      <a class="password-forget" href="" style="display:block;">パスワードをお忘れですか？</a>
      <a class="password-forget" href="contact.php" style="display:block;">お問い合わせはこちら</a>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        会員登録
      </button>
    </div>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
  </form>

  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="position:relative;">
          <h5 class="modal-title" >会員登録</h5>
          <button style="position:absolute; right:5%; outline:none;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding:0;">
          <form class="form-signin" method="post" action="user_insert.php">
            <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72"
              height="72">
            <label for="inputEmail" class="sr-only">user name</label>
            <input type="text" name="lid" class="form-control mb-3" placeholder="user name" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="email" class="form-control mb-3" placeholder="Email address" required>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="lpw" class="form-control mb-3" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">登録する</button>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>