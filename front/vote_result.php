<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投票</title>
  <!-- <link rel="stylesheet" href="./css/index.css"> -->
  <link rel="stylesheet" href="./css/login.css">
  <style>
    ::-webkit-scrollbar {
      display: none;
    }

    .container {
      width: 100vh;
      overflow: scroll;
    }

    .logbtn {
      width: 40%;
      margin-top: 1rem;
      height: 40px;
    }

    .cannotpollbtn {
      width: 40%;
      margin-top: 1rem;
    }

    #uploadForm {
      width: 400px;
      margin: 1rem auto;
      font-size: 1.25rem;
      padding: 1rem;
    }

    #list {
      border-collapse: collapse;
      box-shadow: 0 0 10px #ccc;
      margin: 1rem auto;
    }

    #list img {
      width: 150px;
    }

    #list td,
    #list th {
      border: 1px solid #ccc;
      padding: 0.5rem 1.1rem;
      font-size: 1.15rem;
    }

    #list tr:hover {
      background: lightgreen;
      transform: scale(1.1);
    }

    .reload {
      display: block;
      margin: 0 auto;
      padding: 0.1rem 0.3rem;
      font-size: 1rem;
    }

    tr {
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- 上方選單 -->
  <nav>
    <?php include "./layout/header.php"; ?>
  </nav>
  <!-- 主要內容 -->
  <div class="container">

    <?php

    $subject = find_something_in_table("subjects", $_GET['id']);
    $opts = show_table_contents("options", ['subject_id' => $_GET['id']]);
    $sqlmember_had_voted = "SELECT acc FROM `users` WHERE id in (select user_id from logs where subject_id={$_GET['id']});";
    $member_had_voted = $pdo->query($sqlmember_had_voted)->fetchAll(PDO::FETCH_ASSOC);
    // print($sqlmember_had_voted);
    ?>

    <h1 class="text-center"><?= $subject['subject']; ?></h1>

    <div style="width: 600px;margin:auto">
      <div style="text-align: center; margin:1rem;">總投票數:<?= $subject['total']; ?></div>
      <div style="text-align: center; margin:1rem;">已投過的帳號:</div>
      <?php
      // dd($member_had_voted);
      $memberarray = [];
      foreach ($member_had_voted as $key => $member) {
        $memberarray[] = $member['acc'];
      }
      $memberstring = implode(', ', $memberarray);
      ?>
      <div style="text-align: center; margin:1rem;"><?= $memberstring; ?></div>
      <table class="result-table">
        <tr>
          <td>選項</td>
          <td>投票數</td>
          <td>比例</td>
        </tr>
        <?php
        $sum = 0;
        foreach ($opts as $opt) {
          $sum += $opt['total'];
        }
        foreach ($opts as $opt) {
          $sum = ($subject['total'] == 0) ? 1 : $sum;
          $rate = $opt['total'] / $sum;
        ?>
          <tr>
            <td><?= $opt['option']; ?></td>
            <td><?= $opt['total']; ?></td>
            <td>
              <!-- 長條圖 -->
              <div style="display:inline-block;height:24px;background-image: linear-gradient(to left, #fed6e3 0%, #a8edea 100%);width:<?= 300 * $rate; ?>px;"></div>
              <?= number_format($rate * 100) . "%"; ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </table>


      <?php
      if (isset($_SESSION['user'])) {
        $sqllog = "select count(user_id) as number from `logs` where subject_id='{$_GET['id']}' and `user_id`=(select id from `users` where acc = '{$_SESSION['user']}') ";
        $cannotpoll = $pdo->query($sqllog)->fetch(PDO::FETCH_ASSOC);

        // $update_option = "UPDATE `options` SET `total` = total -1  WHERE id in (SELECT option_id FROM `logs` WHERE user_id = (select id from `users` where acc = '{$_SESSION['user']}') and subject_id='{$_GET['id']}') ";
        // $resetoption = $pdo->exec($update_option);

        // $update_subject_total = "UPDATE subjects set total = total -1  where id='{$_GET['id']}' ";
        // $resetsubject = $pdo->exec($update_subject_total);

        // $deletelog = "delete from `logs` where subject_id='{$_GET['id']}' and `user_id`=(select id from `users` where acc = '{$_SESSION['user']}') ";
        // $resetlog = $pdo->exec($deletelog);

        // $undosql = "UPDATE `options` SET `total` = total - 1  WHERE id in (SELECT option_id FROM `logs` WHERE user_id = (select id from `users` where acc = '{$_SESSION['user']}') and subject_id='{$_GET['id']}'); UPDATE subjects set total = total - 1  where id='{$_GET['id']}'; delete from `logs` where subject_id='{$_GET['id']}' and `user_id`=(select id from `users` where acc = '{$_SESSION['user']}')";
        // $undo = $pdo->exec($undosql);
        $id = $_GET['id'];


        $sqlforbidden = "select * from subjects where id={$_GET['id']}";
        $forbidden = $pdo->query($sqlforbidden)->fetch(PDO::FETCH_ASSOC);

        $today = strtotime("now");
        $end = strtotime($forbidden['end']);
        if ($forbidden['switch'] == 1 && (strtotime($forbidden['end']) - strtotime("now")) > 0) {

          if (!$cannotpoll['number']) {
      ?>
            <button type="submit" class="logbtn" onclick="location.href='?do=vote&id=<?= $_GET['id']; ?>'">我要投票</button>
          <?php } else { ?>
            <button class="logbtn">無法投票</button>
            <button class="logbtn" onclick="location.href='./front/resetpolling.php?id=<?= $id; ?>'">重新投票</button>

        <?php
          }
        } else if ($forbidden['switch'] == 1 && (strtotime($forbidden['end']) - strtotime("now")) <= 0) {
          // print("投票時間已經截止，如有疑問請聯絡管理員");
          print("<div style='text-align: center; margin:1rem;'>投票時間已經截止，如有疑問請聯絡管理員</div>");
        } else if ($forbidden['switch'] == 0 && (strtotime($forbidden['end']) - strtotime("now")) > 0) {
          // print("投票已被暫時關閉，如有疑問請聯絡管理員");
          print("<div style='text-align: center; margin:1rem;'>投票已被暫時關閉，如有疑問請聯絡管理員</div>");
        } else {
          // print("投票已被暫時關閉，且投票時間已經截止，如有疑問請聯絡管理員");
          print("<div style='text-align: center; margin:1rem;'>投票已被暫時關閉，且投票時間已經截止，如有疑問請聯絡管理員</div>");
        }
        ?>
        <!-- 如果登入才顯示投票按鈕 -->
      <?php
      } else {
      ?>
        <div>
          <a href="login.php"><input type="submit" class="logbtn" value="登入"></a>
        </div>
      <?php
      }
      ?>
    </div>

</body>

</html>