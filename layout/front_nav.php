<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .slideshow {
      display: block;
      width: 1260px;
      height: 300px;
      background-color: greenyellow;
      margin: 0;
      /* margin-left: -100px; */
      margin-left: 6%;
      margin-top: 2vh;
      border-radius: 15px;
      z-index: 5;
    }

    img {
      overflow: hidden;
    }

    nav a {
      display: block;
      text-decoration: none;
      /* padding-left: 20px; */
      /* background-color: blue; */
      font-size: 17px;
    }
  </style>
  <link rel="stylesheet" href="../css/index.css">
</head>

<body>

  <!-- 上方選單顯示 -->
  <?php
  if (isset($_SESSION['user'])) {
    $sql = "select admin  from `users` where acc='{$_SESSION['user']}'";
    $admin = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if ($admin['admin'] == 1) {
  ?>
      <a href="back.php">管理投票</a>
      <a href="logout.php">登出</a><!-- 如果有登入資料就顯示登出 -->
      <a href="member_center.php">會員中心</a>
      <a href="member_managements.php">會員列表</a>
    <?php
    } else {
    ?>
      <a href="logout.php">登出</a><!-- 如果有登入資料就顯示登出 -->
      <a href="member_center.php">會員中心</a>
    <?php
    }
  } else {
    ?>
    <nav>
      <a href="login.php">會員登入</a>
      <a href="register.php">還沒有會員？註冊</a>
    </nav>
    <div class="slideshow">
      <!-- <p>123</p> -->
      <p style="text-align:center;font-size:20px;">廣告牆</p>
      <img src="../img/header.png" alt="">
    </div>
    <!-- 如果沒有登入資料就顯示登入 -->
  <?php
  }
  ?>

</body>

</html>