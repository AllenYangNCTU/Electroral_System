<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Center</title>
  <link rel="stylesheet" href="./css/index.css">
  <style>
    .container {
      width: 120vh;
      height: 85vh;
    }

    h2 {
      margin-bottom: 1rem;
      text-align: center;
    }

    div {
      margin-left: 15rem;
      margin-top: 1rem;
    }

    .remove {
      text-align: center;
      color: #eee;
    }

    .remove:hover {
      color: red;
    }

    .logbtn {
      margin: 0 auto;
      display: block;
      width: 40%;
      height: 8vh;
      border: none;
      background-image: linear-gradient(to bottom, #FCFF00 0%, #FFA8A8 100%);
      background-size: 200%;
      outline: none;
      cursor: pointer;
      transition: .5s;
      border-radius: 20px;
      margin-top: 2vh;
    }

    .inputBox {
      position: relative;
    }

    #toggle {
      position: absolute;
      transform: translateY(20%);
      width: 1.2rem;
      height: 1.2rem;
      background: url(./img/show.png);
      background-size: cover;
      cursor: pointer;
      margin-left: 0.2rem;
    }

    #toggle.hide {
      background: url(./img/hide.png);
      background-size: cover;
    }
  </style>
</head>
<?php
include "./api/base.php"; //連接資料庫

$sql = "select * from `users` where acc='{$_SESSION['user']}'";
$user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC); //導出資料
?>

<body>
  <?php
  ?>
  <?php include "./layout/front_nav.php"; ?>
  <div class="container">
    <h1>Member Center</h1>

    <?php
    if (!$user['admin']) {
    ?>
      <a class="remove" href="remove_acc.php?id=<?= $user['id']; ?>">Delete Account</a>
    <?php
    }
    ?>
    <h2>Welcome~<?= $_SESSION['user']; ?>~</h2>
    <?php
    $sql_birthday = "select count(name) as num from users where (EXTRACT(MONTH FROM birthday) = EXTRACT(MONTH FROM CURRENT_DATE)) && (EXTRACT(DAY FROM birthday) = EXTRACT(DAY FROM CURRENT_DATE)) && name = '{$_SESSION['user']}'";
    $birthday = $pdo->query($sql_birthday)->fetch(PDO::FETCH_ASSOC);
    if ($birthday['num']) { ?>

      <br>
      <h2>Happy Birthday ~ <?= $_SESSION['user']; ?> ~ Today is your birthday.</h2>
    <?php
    }
    ?>
    <div>
      <span>Account：</span>
      <?= $user['acc']; ?>
    </div>
    <div class="inputBox">
      <span>Passwords：<a href="./back/update_pwd.php?account=<?= $user['acc']; ?>">Change Passwords</a>
      </span>
    </div>
    <div>
      <span>Name：</span>
      <?= $user['name']; ?>
    </div>
    <div>
      <span>Birthday：</span>
      <?= $user['birthday']; ?>
    </div>
    <div>
      <span>e-mail：</span>
      <?= $user['email']; ?>
    </div>
    <div>
      <span>Rank：</span>
      <?php if ($user['admin'] == 1) {
        print("Admin");
      } else {
        print("Member");
      }
      ?>
    </div>

    <form action="edit.php" method="post">
      <input type="hidden" name="id" value="<?= $user['id']; ?>">
      <input type="submit" class="logbtn" value="Edit">
    </form>

  </div>
  <?php include "./layout/footer.php"; ?>
</body>

</html>