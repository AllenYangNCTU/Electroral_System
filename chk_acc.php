<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/login.css">
  <style>
    .container{
  width: 70vh;
  height: 50vh;
}
h2{
  margin-top: 15vh;
}
  </style>
</head>
<body>
    <!-- 上方選單 -->
<nav>
    <?php include "./layout/header.php";?>
  </nav>
  <!-- 主要內容 -->
<div class="container">
  
    <h1>密碼提示</h1>

    <?php
include "./api/base.php";//連線資料庫

$acc=$_POST['acc'];

$sql="SELECT * FROM `users` WHERE `acc`='$acc'";//尋找資料表的acc相符的資料

$user=$pdo->query($sql)->fetch();


if(empty($user)){//如果資料庫有這個帳號的話給密碼
  echo "查無此帳號";
}else{
  echo "<h2>你當初提供的密碼提示為:".$user['passnote']."</h2>";
}
?>
</div>
<!-- 頁尾 -->
<?php include "./layout/footer.php";?>

</body>
</html>