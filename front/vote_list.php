<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .subject_container {
      display: flex;
      justify-content: space-evenly;
      /* float: left; */
      border-radius: 15px;
      margin-top: 5px;
    }

    .subject_container_voted {
      display: flex;
      justify-content: space-evenly;
      /* float: left; */
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
      /* margin-left: 4%; */
    }

    .subject_li_title {
      width: calc(100% / 6);
      display: inline-block;
      text-align: left;
      font-weight: bold;
      font-size: 20px;
      /* margin-left: 4%; */
      padding-left: 3%;
      display: flex;
      align-items: center;
      justify-content: center;
      /* background-color: #a8edea; */
    }

    .subject_container:hover {
      background-color: #fed6e3;
      /* background-color: #a8edea; */
      transform: scale(1.05, 1.05);
      transition: all 0.5s ease-out;
      margin-top: 15px;
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
  <h1>投票列表</h1>
  <!-- 分類 -->
  <div id="list">
    <label for="types">分類</label>
    <select name="types" id="types" onchange="location.href=`?filter=${this.value}<?= $p; ?><?= $querystr; ?>`">
      <option value="0">全部</option>
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

  <!-- 投票列表 -->
  <div>
    <ul class="list">
      <li class="list-header">
        <div>類別：</div>
        <div>投票主題：</div>
        <!-- 單複選題排序 -->
        <?php
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href="?order=multiple&type=desc<?= $p; ?><?= $queryfilter ?>">單/複選題：</a></div>
        <?php
        } else {
        ?>
          <div><a href="?order=multiple&type=asc<?= $p; ?><?= $queryfilter ?>">單/複選題：</a></div>
        <?php
        }
        ?>

        <!-- 投票期間排序 -->
        <?php
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href="?order=end&type=desc<?= $p; ?><?= $queryfilter ?>">投票期間：</a></div>
        <?php
        } else {
        ?>
          <div><a href="?order=end&type=asc<?= $p; ?><?= $queryfilter ?>">投票期間：</a></div>
        <?php
        }
        ?>

        <!-- 剩餘天數排序 -->
        <?php
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href="?order=remain&type=desc<?= $p; ?><?= $queryfilter ?>">剩餘天數：</a></div>
        <?php
        } else {
        ?>
          <div><a href="?order=remain&type=asc<?= $p; ?><?= $queryfilter ?>">剩餘天數：</a></div>
        <?php
        }
        ?>

        <!-- 投票人數作排序 -->
        <?php
        if (isset($_GET['type']) && $_GET['type'] == 'asc') {
        ?>
          <div><a href='?order=total&type=desc<?= $p; ?><?= $queryfilter ?>'>投票人數：</a></div>
        <?php
        } else {
        ?>
          <div><a href='?order=total&type=asc<?= $p; ?><?= $queryfilter ?>'>投票人數：</a></div>
        <?php
        }
        ?>
        <!-- 投票人數排序結束 -->
      </li>
      <?php
      // 偵測是否需要排序
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
      // 建立分業所需的變數群

      $filter = [];
      if (isset($_GET['filter'])) {
        if (!$_GET['filter'] == 0) {
          $filter = ['type_id' => $_GET['filter']];
        }
      }

      $total = count_avg_min_max('subjects', 'count', 'id', $filter);
      $div = 10; //每頁有幾筆資料
      $pages = ceil($total / $div); //總頁數
      $now = isset($_GET['p']) ? $_GET['p'] : 1; //如果沒有其他頁數就顯示第一頁
      $start = ($now - 1) * $div;
      $page_rows = " limit $start,$div";



      $subjects = show_table_contents('subjects', $filter, $orderStr . $page_rows);
      //取得所有投票列表
      foreach ($subjects as $subject) {
        $subject_container_style =  "subject_container";
        if (isset($_SESSION['user'])) {


          $voted = "select count(id) as num from `logs` where user_id=(select id from `users` where acc = '{$_SESSION["user"]}') and subject_id='{$subject["id"]}'";
          $vote_history = $pdo->query($voted)->fetch(PDO::FETCH_ASSOC);
          $subject_container_style = ($vote_history['num'] == 0) ? "subject_container" : "subject_container_voted";
        }


        echo "<a href='?do=vote_result&id={$subject['id']}'>"; //要把投票帶去哪
        echo "<div class=$subject_container_style>";
        $sql_title = "select name from types where  `id`= '{$subject["type_id"]}'";
        $typename = $pdo->query($sql_title)->fetch(PDO::FETCH_ASSOC);
        echo "<div class='subject_li'>{$typename['name']}</div>";
        echo "<div class='subject_li_title'>{$subject['subject']}</div>"; //只取得欄位

        if ($subject['multiple'] == 0) {
          echo "<div class='subject_li'>單選題</div>";
        } else {
          echo "<div class='subject_li'>複選題</div>";
        }

        echo "<div class='subject_li durations'>"; //投票開始與結束時間
        echo $subject['start'] . "~" . $subject['end'];
        echo "</div>";

        echo "<div class='subject_li remain_days'>"; //投票剩餘天數
        $today = strtotime("now");
        $end = strtotime($subject['end']);
        if (($end - $today) > 0) { //如果投票還在進行
          $remain = floor(($end - $today) / (60 * 60 * 24));
          echo "倒數" . $remain . "天結束";
        } else { //如果投票已經截止
          echo "<span style='color:grey;'>投票已截止</span>";
        }
        echo "</div>";

        echo "<div class='subject_li'>{$subject['total']}</div>"; //投票總人數
        echo "</div>";
        echo "</a>";
      }
























      ?>

    </ul>
    <!-- 列表分頁頁碼 -->
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