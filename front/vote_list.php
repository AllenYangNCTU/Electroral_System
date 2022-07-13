<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VOTE LIST</title>
  <style>
    .subject_container {
      display: flex;
      justify-content: space-evenly;
      border-radius: 15px;
      margin-top: 5px;
    }

    .subject_container_voted {
      display: flex;
      justify-content: space-evenly;
      border-radius: 15px;
      margin-top: 5px;
      background-color: #a8edea;
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

    .subject_container:hover {
      background-color: #fed6e3;
      transform: scale(1.05, 1.05);
      transition: all 0.5s ease-out;
      margin-top: 15px;
    }

    div {
      color: #696AAD;
    }

    h1 {
      color: #696AAD;
    }

    .list-header div {
      background-color: #696AAD;
    }
  </style>
</head>

<body>


  <?php
  $p = "";
  if (isset($_GET['p'])) {
    $p = "&p={$_GET['p']}";
  }
  $querystr = "";
  if (isset($_GET['order'])) {
    $querystr = "&order={$_GET['order']}&type={$_GET['type']}";
  }

  $queryfilter = "";
  if (isset($_GET['filter'])) {
    $queryfilter = "&filter={$_GET['filter']}";
  }

  ?>
  <h1>VOTE LIST</h1>
  <div id="list">
    <form action="./index.php?filter=0<?= $p; ?><?= $querystr; ?>" method="post">
      <input type="text" name="search_string" id="" placeholder="search">
      <input type="submit" value="submit">
    </form>
    <?php
    if (isset($_POST['search_string'])) {

      $sql_search = "select * from subjects where subject like '%{$_POST['search_string']}%'";
      $search = $pdo->query($sql_search)->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <label for="types">Classification</label>


    <select name="types" id="types" onchange="location.href=`?filter=${this.value}<?= $p; ?><?= $querystr; ?>`">

      <option value="0">All</option>
      <?php

      $types = show_table_contents("types");
      foreach ($types as $type) {
        $selected = (isset($_GET['filter']) && $_GET['filter'] == $type['id']) ? 'selected' : '';
        echo "<option value='{$type['id']}' $selected>";
        echo $type['name'];
        echo "</option>";
      }

      ?>
    </select>
  </div>


  <div>
    <ul class="list">
      <li class="list-header">
        <div>Classification：</div>
        <div>Topic：</div>
        <?php
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href="?order=multiple&type=desc<?= $p; ?><?= $queryfilter ?>">Multiple choice：</a></div>
        <?php
        } else {
        ?>
          <div><a href="?order=multiple&type=asc<?= $p; ?><?= $queryfilter ?>">Multiple choice：</a></div>
        <?php
        }
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href="?order=end&type=desc<?= $p; ?><?= $queryfilter ?>">Beginning and end：</a></div>
        <?php
        } else {
        ?>
          <div><a href="?order=end&type=asc<?= $p; ?><?= $queryfilter ?>">Beginning and end：</a></div>
        <?php
        }
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href="?order=remain&type=desc<?= $p; ?><?= $queryfilter ?>">Time remaining：</a></div>
        <?php
        } else {
        ?>
          <div><a href="?order=remain&type=asc<?= $p; ?><?= $queryfilter ?>">Time remaining：</a></div>
        <?php
        }
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href='?order=total&type=desc<?= $p; ?><?= $queryfilter ?>'>Number of voters：</a></div>
        <?php
        } else {
        ?>
          <div><a href='?order=total&type=asc<?= $p; ?><?= $queryfilter ?>'>Number of voters：</a></div>
        <?php
        }
        ?>
      </li>
      <?php
      $orderStr = '';
      if (isset($_GET['order'])) {
        $_SESSION['order']['col'] = $_GET['order'];
        $_SESSION['order']['type'] = $_GET['type'];

        if ($_GET['order'] == 'remain') {
          $orderStr = "ORDER BY DATEDIFF(`end`,now()) {$_SESSION['order']['type']}";
        } else {
          $orderStr = "ORDER BY `{$_SESSION['order']['col']}` {$_SESSION['order']['type']}";
        }
      }
      $filter = [];
      if (isset($_GET['filter'])) {
        if (!$_GET['filter'] == 0) {
          $filter = ['type_id' => $_GET['filter']];
        }
      }
      $total = count_avg_min_max('subjects', 'count', 'id', $filter);
      $div = 10;
      $pages = ceil($total / $div);
      $now = isset($_GET['p']) ? $_GET['p'] : 1;
      $start = ($now - 1) * $div;
      $page_rows = " limit $start,$div";
      if (isset($_POST['search_string'])) {
        $subjects = $search;
      } else {

        $subjects = show_table_contents('subjects', $filter, $orderStr . $page_rows);
      }

      foreach ($subjects as $subject) {


        $subject_container_style =  "subject_container";
        if (isset($_SESSION['user'])) {
          $voted = "select count(id) as num from `logs` where user_id=(select id from `users` where acc = '{$_SESSION["user"]}') and subject_id='{$subject["id"]}'";
          $vote_history = $pdo->query($voted)->fetch(PDO::FETCH_ASSOC);
          $subject_container_style = ($vote_history['num'] == 0) ? "subject_container" : "subject_container_voted";
        }
        echo "<a href='?do=vote_result&id={$subject['id']}'>";


        echo "<div class=$subject_container_style>";
        $sql_title = "select name from types where  `id`= '{$subject["type_id"]}'";
        $typename = $pdo->query($sql_title)->fetch(PDO::FETCH_ASSOC);
        echo "<div class='subject_li'>{$typename['name']}</div>";

        echo "<div class='subject_li_title'>{$subject['subject']}</div>";

        if ($subject['multiple'] == 0) {
          echo "<div  class='subject_li'>Multiple-Choice</div>";
        } else {
          echo "<div class='subject_li'>Multiple-Answers</div>";
        }

        echo "<div class='subject_li' style='font-size: 16px;'> ";
        echo $subject['start'] . " " . $subject['starttime'] . "~" . "<br>" . $subject['end'] . " " . $subject['starttime'];
        echo "</div>";


        echo "<div style='font-size:14px;' class='subject_li'>";
        $today = strtotime("now");
        $end = strtotime($subject['end'] . " " . $subject['endtime']);
        if ((($end - $today) > 0) && $subject['switch'] == 1) {
          $remainday = ceil(($end - $today) / 86400);
          $remainhours = ceil((($end - $today) % 86400) / 3600);
          $remainminutes = ceil((($end - $today) % 3600) / 60);
          $remainseconds = ceil(($end - $today) % 60);
          echo  $remainday . " Days " . $remainhours . " H " . $remainminutes . " M " . $remainseconds . " S";
        } else if ((($end - $today) > 0) && $subject['switch'] == 0) {
          echo "<span style='color:grey;'>Poll had been temporarily closed</span>";
        } else {
          echo "<span style='color:grey;'>Cut-off voting</span>";
        }
        echo "</div>";


        echo "<div class='subject_li'>{$subject['total']}</div>";
        echo "</div>";

        echo "</a>";
      }
      ?>
    </ul>
    <div class="text-center">
      <?php
      if ($pages > 1) {
        for ($i = 1; $i <= $pages; $i++) {
          echo "<a href='?p={$i}{$querystr}{$queryfilter}'>&nbsp;";
          echo $i;
          echo "&nbsp;</a>";
        }
      }
      ?>
    </div>
  </div>
</body>

</html>