<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員中心</title>
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
      /* margin-left: 25vw; */
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
      background-image: linear-gradient(to top, #fed6e3 0%, #a8edea 100%, #fed6e3 0%, #a8edea 100%, #fed6e3 0%);
      background-size: 200%;
      outline: none;
      cursor: pointer;
      transition: .5s;
      border-radius: 20px;
      margin-top: 2vh;
    }

    .inputBox{
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
  <!-- 上方選單 -->
  <nav>
    <?php include "./layout/header.php"; ?>
    <?php include "./layout/front_nav.php"; ?>
  </nav>
  <!-- 主要內容 -->
  <div class="container">
    <h1>會員中心</h1>

    <?php
    if ($_SESSION['user'] != 'admin') {
    ?>
      <a class="remove" href="remove_acc.php?id=<?= $user['id']; ?>">刪除帳號</a>
    <?php
    }
    ?>

    <h2>歡迎<?= $_SESSION['user']; ?></h2>
    <div>
      <span>序號：</span>
      <?= $user['id']; ?>
    </div>
    <div>
      <span>帳號：</span>
      <?= $user['acc']; ?>
    </div>
    <div class="inputBox">
      <span>密碼：
        <input type="password" placeholder="密碼" id="password" value="<?= $user['pw']; ?>">
      </span>
      <!-- 偵測按下去時執行 function showHide的內容 -->
      <span id="toggle" onclick="showHide();"></span>
    </div>
    <div>
      <span>姓名：</span>
      <?= $user['name']; ?>
    </div>
    <div>
      <span>生日：</span>
      <?= $user['birthday']; ?>
    </div>
    <div>
      <span>地址：</span>
      <?= $user['addr']; ?>
    </div>
    <div>
      <span>e-mail：</span>
      <?= $user['email']; ?>
    </div>
    <div>
      <span>密碼提示：</span>
      <?= $user['passnote']; ?>
    </div>

    <form action="edit.php" method="post">
      <input type="hidden" name="id" value="<?= $user['id']; ?>"> <!-- 隱藏按鈕帶參數過去 -->
      <input type="submit" class="logbtn" value="編輯">
    </form>

  </div>
  <!-- 頁尾 -->
  <?php include "./layout/footer.php"; ?>

  <script>
    // 宣告一個password 是id-password裡面的內容
    const password = document.getElementById('password')
    // 宣告一個toggle 是取得id toggle的內容
    const toggle = document.getElementById('toggle')

    // 設定一個function 叫做showHide
    function showHide() {
      // 如果 password的內容 跟 password相同時
      if (password.type === 'password') {
        // 設定為文本顯示
        password.setAttribute('type', 'text')
        toggle.classList.add('hide')
      } else {
        // 反之 隱藏密碼
        password.setAttribute('type', 'password')
        toggle.classList.remove('hide')
      }
    }
  </script>
</body>

</html>