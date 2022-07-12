<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投票</title>
  <link rel="stylesheet" href="./css/login.css">
  <style>
    ::-webkit-scrollbar {
      display: none;
    }

    .container {
      width: 100vh;
      overflow: scroll;

      background-image: linear-gradient(45deg, #F0FF00 0%, #58CFFB 100%);

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

    button {
      cursor: pointer;
      border: none
    }
  </style>
</head>

<body>
  <nav>
    <?php
    include "../layout/header.php";
    include "../api/base.php";
    ?>

  </nav>
  <div class="container">
    <?php
    $subject = find_something_in_table("subjects", $_GET['id']);
    $opts = show_table_contents("options", ['subject_id' => $_GET['id']]);
    $sqlmember_had_voted = "SELECT acc FROM `users` WHERE id in (select user_id from logs where subject_id={$_GET['id']});";
    $member_had_voted = $pdo->query($sqlmember_had_voted)->fetchAll(PDO::FETCH_ASSOC);
    $secret = "";
    if ($subject['secret']) {
      $secret = "Open ";
    } else {
      $secret = "Secret ";
    }
    ?>
    <h1 class="text-center"><?= $subject['subject'];
                            print("(" . $secret . "Ballot)"); ?></h1>

    <div style="width: 600px;margin:auto">
      <div style="text-align: center; margin:1rem;">Number of Voters: <?= $subject['total']; ?></div>
      <?php
      $member_total_array = [];
      foreach ($member_had_voted as $member) {
        $member_total_array[] = $member['acc'];
      }
      $member_total_string = implode(', ', $member_total_array);
      if ($subject['secret']) {
      ?>
        <div style="text-align: center; margin:1rem;">Accounts that had voted :</div>
        <div style="text-align: center; margin:1rem;"><?php print($member_total_string); ?></div>
      <?php
      }
      ?>
      <table class="result-table">
        <tr>
          <td>Option</td>
          <td>Total</td>
          <td>Ratio</td>
          <?php
          if ($subject['secret']) {
          ?>
            <td>Account</td><?php
                          } ?>
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
            <td style="text-align:left">
              <div style="display:inline-block;height:24px;background-image: linear-gradient(to left, #FCFF00 0%, #FFA8A8 <?= 100 * $rate; ?>%);;width:<?= 300 * $rate; ?>px;"></div>
              <?= number_format($rate * 100) . "%"; ?>
            </td>
            <?php
            $sqloption = "select acc from users where id in (select user_id from logs where option_id={$opt['id']})";
            $optionresult = $pdo->query($sqloption)->fetchAll(PDO::FETCH_ASSOC);
            $userarray = [];
            foreach ($optionresult as $optionmember) {
              $userarray[] = $optionmember['acc'];
            }
            $memberstring = "";
            $memberstring .= implode(', ', $userarray);
            if ($subject['secret']) {
            ?>
              <td><?php print($memberstring); ?> </td>
            <?php
            }
            ?>
          </tr>
        <?php
        }
        ?>
      </table>
      <?php
      if (isset($_SESSION['user'])) {
        $sqllog = "select count(user_id) as number from `logs` where subject_id='{$_GET['id']}' and `user_id`=(select id from `users` where acc = '{$_SESSION['user']}')";
        $cannotpoll = $pdo->query($sqllog)->fetch(PDO::FETCH_ASSOC);
        $id = $_GET['id'];
        $sqlforbidden = "select * from subjects where id={$_GET['id']}";
        $forbidden = $pdo->query($sqlforbidden)->fetch(PDO::FETCH_ASSOC);
        $today = strtotime("now");
        $end = strtotime($forbidden['end']);
        if ($forbidden['switch'] == 1 && (strtotime($forbidden['end']) - strtotime("now")) > 0) {
          if (!$cannotpoll['number']) {

            $sql_age_limit = "select birthday from users where acc = '{$_SESSION["user"]}'";
            $age_limit = $pdo->query($sql_age_limit)->fetch(PDO::FETCH_ASSOC);
            $age_limit_str = strtotime($age_limit['birthday']);
            if ((($today - $age_limit_str) / 86400 / 365) >= $forbidden['age_limit'] && (($today - $age_limit_str) / 86400 / 365) <= $forbidden['age_limit_below']) {
      ?>
              <button type="submit" class="logbtn" onclick="location.href='?do=vote&id=<?= $_GET['id']; ?>'">Vote This Topic</button>
            <?php
            } else if ((($today - $age_limit_str) / 86400 / 365) < $forbidden['age_limit']) {
              print("<div style='text-align: center; margin:1rem;'> You have to be over {$forbidden['age_limit']} years old to vote this topic!</div>");
            } else if ((($today - $age_limit_str) / 86400 / 365) > $forbidden['age_limit_below']) {
              print("<div style='text-align: center; margin:1rem;'> You have to be under {$forbidden['age_limit_below']} years old to vote this topic!</div>");
            }
          } else { ?>
            <div style="text-align: center; margin:1rem;">You had voted this topic.</div>
            <button class="logbtn" onclick="location.href='./front/resetpolling.php?id=<?= $id; ?>'">Reset your vote, and vote this topic again</button>
        <?php
          }
        } else if ($forbidden['switch'] == 1 && (strtotime($forbidden['end']) - strtotime("now")) <= 0) {
          print("<div style='text-align: center; margin:1rem;'>Cut-off voting! If you have any question, please contact your administrator.</div>");
        } else if ($forbidden['switch'] == 0 && (strtotime($forbidden['end']) - strtotime("now")) > 0) {
          print("<div style='text-align: center; margin:1rem;'>This topic had been temporarily closed. If you have any question, please contact your administrator.</div>");
        } else {
          print("<div style='text-align: center; margin:1rem;'>This topic had closed. If you have any question, please contact your administrator.</div>");
        }
        ?>
      <?php
      } else {
      ?>
        <div>
          <a href="login.php"><input type="submit" class="logbtn" value="Log in"></a>
        </div>
      <?php
      }
      ?>
    </div>
</body>

</html>