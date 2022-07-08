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
  <?php include "./layout/front_nav.php"; ?>
  <div class="container">
    <?php
    if (isset($_GET['do'])) {
      $file = './front/' . $_GET['do'] . ".php";
    }
    if (isset($file) && file_exists($file)) {
      include $file;
    } else {
      include "./front/vote_list.php";
    }
    ?>
  </div>
  </div>
  <?php include "./layout/footer.php"; ?>
</body>

</html>