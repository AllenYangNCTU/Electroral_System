<?php
include_once "./api/base.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electroral System</title>
  <link rel="stylesheet" href="./css/index.css">
  <style>
    body {
      background-image: linear-gradient(225deg, #FCFF00 0%, #FFA8A8 100%);
    }

    .container {
      background-image: linear-gradient(225deg, #FCFF00 0%, #FFA8A8 100%);

    }
  </style>
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