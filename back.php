<?php include_once "./api/base.php";  // 因為要使用到資料庫 所以在最開端先引入 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>administrative center</title>
  <link rel="stylesheet" href="./css/back.css">
  <style>
    .subject_container_open {
      display: flex;
      justify-content: space-evenly;
      border-radius: 15px;
    }

    .subject_container_open:hover {
      background-color: #fed6e3;
      transform: scale(1.05, 1.05);
      transition: all 0.5s ease-out;
    }

    .subject_container_close {
      display: flex;
      justify-content: space-evenly;
      border-radius: 15px;
      background-color: #aaa;
    }

    .subject_container_close:hover {
      background-color: #fed6e3;
      transform: scale(1.05, 1.05);
      transition: all 0.5s ease-out;
    }

    .subject_li {
      width: calc(100% / 6);
      display: inline-block;
      text-align: center;
      font-weight: bold;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .subject_li_title {
      width: calc(100% / 6);
      display: inline-block;
      text-align: left;
      font-weight: bold;
      font-size: 20px;
      padding-left: 3%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .list-header {
      display: flex;
      justify-content: space-evenly;
      text-align: center;

    }

    .list-header div {
      width: calc(100% / 6);
      background: #504d78;
      color: #ccc;
    }

    .chmod {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: rgb(15, 203, 181);
      box-shadow: 3px 3px 10px #aaa;
      font-size: 10px;
    }

    .chmod:hover {
      background: #504d78;
      color: #fff;
    }

    .edit {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 20px;
      box-shadow: 3px 3px 10px #aaa;
      font-size: 10px;
    }

    .edit:hover {
      background: #504d78;
      color: #fff;
    }

    .del {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: rgb(255, 117, 117);
      box-shadow: 3px 3px 10px #aaa;
      font-size: 10px;
    }

    .del:hover {
      background: #504d78;
      color: #fff;
    }

    .secret_ballot_secret {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: #ff9a57;
      box-shadow: 3px 3px 10px #aaa;
      font-size: 10px;
    }

    .secret_ballot_secret:hover {
      background: #504d78;
      color: #fff;
    }

    .secret_ballot_open {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: #d8e12e;
      box-shadow: 3px 3px 10px #aaa;
      font-size: 10px;
    }

    .secret_ballot_open:hover {
      background: #504d78;
      color: #fff;
    }

    .container {
      background-image: linear-gradient(45deg, #F0FF00 0%, #58CFFB 100%);
      /* background-image: none; */
    }

    nav a {
      display: block;
      text-decoration: none;
      font-size: 17px;
      margin-left: -45rem;
    }
  </style>
</head>

<body>
  <nav>
    <?php include "./layout/header.php"; ?>
    <?php include "./layout/back_nav.php"; ?>
  </nav>
  <div class="container">
    <h1>Administrative Center</h1>

    <?php
    if (isset($_GET['do'])) {
      $file = "./back/" . $_GET['do'] . ".php";
    }

    if (isset($file) && file_exists($file)) {
      include $file;
    } else {
    ?>
      <form style="margin-left:5rem;" action="./index.php?filter=0<?= $p; ?><?= $querystr; ?>" method="post">
        <input type="text" name="search_string" id="" placeholder="search">
        <input type="submit" value="送出">
      </form><br>
      <?php
      if (isset($_POST['search_string'])) {

        $sql_search = "select * from subjects where subject like '%{$_POST['search_string']}%'";
        $search = $pdo->query($sql_search)->fetchAll(PDO::FETCH_ASSOC);
      }
      ?>
      <button style="margin-left:5rem;" class=btn onclick="location.href='?do=add_vote'">Add Topic</button>
      <div>
        <ul>
          <li class="list-header">
            <div>Classification</div>
            <div>Topic</div>
            <div>Multiple Choice</div>
            <div>Begining and end</div>
            <div>Time Remaining</div>
            <div>Number of Voters</div>
            <div>Operation</div>
          </li>
          <?php
          if (isset($_POST['search_string'])) {
            $subjects = $search;
          }
          $subjects = show_table_contents('subjects');
          foreach ($subjects as $subject) {
            if (!$subject['switch']) {
              $subject_container = "subject_container_close";
            } else {
              $subject_container = "subject_container_open";
            }
            echo "<div class=$subject_container>";
            $sql_title = "select name from types where  `id`= '{$subject["type_id"]}'";
            $typename = $pdo->query($sql_title)->fetch(PDO::FETCH_ASSOC);
            echo "<div class='subject_li'>{$typename['name']}</div>";
            echo "<div class='subject_li'>{$subject['subject']}</div>";
            if ($subject['multiple'] == 0) {
              echo "<div class='subject_li'>Multi-Choice</div>";
            } else {
              echo "<div class='subject_li'>Multi-Answers</div>";
            }
            echo "<div class='subject_li' style='font-size: 16px;'> ";
            echo $subject['start'] . " " . $subject['starttime'] . "~" . "<br>" . $subject['end'] . " " . $subject['starttime'];
            echo "</div>";
            echo "<div style='font-size:14px;' class='subject_li'>";
            $today = strtotime("now");
            $end = strtotime($subject['end'] . " " . $subject['endtime']);
            if (($end - $today) > 0) {
              $remainday = ceil(($end - $today) / 86400);
              $remainhours = ceil((($end - $today) % 86400) / 3600);
              $remainminutes = ceil((($end - $today) % 3600) / 60);
              $remainseconds = ceil(($end - $today) % 60);
              echo  $remainday . " D " . $remainhours . " H " . $remainminutes . " M " . $remainseconds . " S";
            } else {
              echo "<span style='color:grey;'>cut-off vote</span>";
            }
            echo "</div>";
            echo "<div class='subject_li'>{$subject['total']}</div>";
            echo "<div class='subject_li'>";
            echo "<a class='edit' href='?do=edit&id={$subject['id']}'>edit</a>";
            echo "<a class='del' href='?do=del&id={$subject['id']}'>delete</a>";
            echo "<a class='chmod' href='./chmod.php?id={$subject['id']}'>on/off</a>";
            if ($subject['secret']) {
              $secret_ballot_class = "secret_ballot_secret";
            } else {
              $secret_ballot_class = "secret_ballot_open";
            }
            echo "<a class=$secret_ballot_class href='./secret_ballot.php?id={$subject['id']}'>open/secret</a>";
            echo "</div>";
            echo "</div>";
          }
          ?>
        </ul>
      </div>
    <?php
    }
    ?>
  </div>
  <?php include "./layout/footer.php"; ?>
</body>

</html>