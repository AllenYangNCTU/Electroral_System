<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Passwords</title>
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <nav>
    <?php include "./layout/header.php"; ?>
  </nav>
  <div class="container">
    <form action="chk_acc.php" method="post">
      <h1>Forgot Passwords</h1>
      <!-- <div class="txtb" style="margin-top:15vh ;"> -->
      <!-- <input type="text" name="acc" id="acc">
        <span data-placeholder="忘記密碼的帳號"></span> -->
      <label for="">Account:</label><br>
      <input type="text" name="acc"><br><br><br>
      <!-- </div> -->
      <!-- <div class="txtb" style="margin-top:15vh ;"> -->
      <!-- <input type="text" name="email" id="email">
        <span data-placeholder="請輸入註冊時的電子郵件"></span> -->
      <label for="">Email:</label><br>
      <input type="text" name="email"><br>
      <!-- </div> -->
      <!-- <div style="margin-top: 10vh;"> -->
      <input type="submit" class="logbtn" value="Verify Account">
      <!-- </div> -->
    </form>
  </div>
  <?php include "./layout/footer.php"; ?>
</body>

</html>