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
    .container {
      width: 70vh;
      height: 50vh;
    }

    h2 {
      margin-top: 15vh;
    }
  </style>
</head>

<body>
  <nav>
    <?php include "./layout/header.php"; ?>
  </nav>
  <div class="container">
    <?php
    include "./api/base.php";
    $acc = $_POST['acc'];
    $email = $_POST['email'];
    $sql = "SELECT * FROM `users` WHERE `acc`='$acc'";
    $user = $pdo->query($sql)->fetch();
    $id = $user['id'];
    if ($user['email'] == $email) {
      header_to("./back/resetpwd.php?do=resetpwd&id=$id&acc=$acc");
    } else if (empty($user)) {
      echo "Account not found";
    ?>
      <br><br><a href="forgot.php">Back</a><br>
    <?php
    } else if ($user['email'] != $email) {
      print("Email error!");
    ?>
      <br><br><a href="forgot.php">Back</a><br>
    <?php
    }
    ?>
  </div>
  <?php include "./layout/footer.php"; ?>

</body>

</html>