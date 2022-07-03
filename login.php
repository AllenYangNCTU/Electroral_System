<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員登入</title>
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <!-- 上方選單 -->
  <nav>
    <?php include "./layout/header.php"; ?>
  </nav>
  <!-- 主要內容 -->
  <div class="container">


    <form action="chklogin.php" method="post">

      <h1>帳號登入</h1>
      <?php
      if (isset($_GET['error'])) { //如果錯誤的話顯示帳密錯誤訊息
      ?>
        <h2 style="color: red;"><?= $_GET['error']; ?></h2>
      <?php
      }
      ?>

      <div class="txtb">
        <input type="text" name="acc">
        <span data-placeholder="帳號"></span>
      </div>

      <div class="txtb">
        <input type="password" name="pw">
        <span data-placeholder="密碼"></span>
      </div>

      <div>
        <input type="submit" class="logbtn" value="登入">
      </div>

      <div class="bottom-text">
        <a href="register.php">尚未註冊?</a>
        <a href="forgot.php">忘記密碼?</a>
      </div>

    </form>
  </div>
  <!-- 頁尾 -->
  <?php include "./layout/footer.php"; ?>

  <script type="text/javascript">
    $(".txtb input").on("focus", function() {
      $(this).addClass("focus");
    });

    $(".txtb input").on("blur", function() {
      if ($(this).val() == "")
        $(this).removeClass("focus");
    });
  </script>

</body>


</html>