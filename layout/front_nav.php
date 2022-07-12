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
      /* background-color: greenyellow; */
      margin: 0;
      /* margin-left: ; */
      margin-left: 8%;
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
      font-size: 17px;
      margin-left: -45rem;
    }

    /* nav {
      height: 1rem;
      display: flex;
      justify-content: center;
      justify-content: space-between;
      width: 20rem;
      margin-left: 5rem;
      margin-top: 1rem;
    } */

    body {
      background-image: linear-gradient(225deg, #FCFF00 0%, #FFA8A8 100%);
    }

    .container {
      background-image: linear-gradient(225deg, #FCFF00 0%, #FFA8A8 100%);

    }
  </style>
  <link rel="stylesheet" href="../css/index.css">
</head>

<body>
  <?php
  if (isset($_SESSION['user'])) {
    $sql = "select admin  from `users` where acc='{$_SESSION['user']}'";
    $admin = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if ($admin['admin'] == 1) {
  ?>
      <nav>
        <a href="index.php">Main Page</a>
        <a href="back.php">Administrative Center</a>
        <a href="logout.php">Log Out</a>
        <a href="member_center.php">Member Center</a>
        <a href="member_managements.php">Member Management Center</a>
      </nav>
    <?php
    } else {
    ?>
      <nav>
        <a href="index.php">Main Page</a>
        <a href="logout.php">Log Out</a>
        <a href="member_center.php">Member Center</a>
      </nav>
    <?php
    }
  } else {
    ?>
    <nav>
      <a href="login.php">Member Login</a>
      <a href="register.php">Member Register</a>
    </nav>
    <div class="slideshow">
      <!-- <p>123</p> -->
      <!-- <p style="text-align:center;font-size:20px;">廣告牆</p> -->
      <img src="../img/header.png" alt="">
    </div>
  <?php
  }
  ?>

</body>

</html>