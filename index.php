<?php
include_once "./api/base.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>問卷系統</title>
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>

<!-- 上方選單 -->
<nav>
    <?php include "./layout/front_nav.php";?>
  </nav>

  <!-- 主要內容 -->
  <div class="container">

    <?php
    if(isset($_GET['do'])){//如果有值可以取得檔案
      $file='./front/'.$_GET['do'].".php";//仔入
    }
    if(isset($file) && file_exists($file)){//如果有這個檔案
      include $file;
    }else{
      include "./front/vote_list.php";
    }
          ?>
  </div>
  </div>

  <!-- 頁尾 -->
  <?php include "./layout/footer.php";?>
</body>

</html>