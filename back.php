<?php include_once "./api/base.php";  // 因為要使用到資料庫 所以在最開端先引入 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投票管理中心</title>
  <link rel="stylesheet" href="./css/back.css">
  <style>
    .subject_container {
      display: flex;
      justify-content: space-evenly;
      border-radius: 15px;
    }

    .subject_container:hover {
      background-color: #fed6e3;
      /* background-color: #a8edea; */
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
      /* border-radius: 15px; */
    }

    .chmod {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: rgb(15, 203, 181);
      box-shadow: 3px 3px 10px #aaa;
      /* margin: 0 5px; */
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
      /* margin: 0 5px; */
      font-size: 10px;
    }

    .edit:hover {
      background: #504d78;
      color: #fff;
    }

    /* 列表的刪除按鈕 */
    .del {
      display: inline-block;
      padding: 3px 12px;
      border: 1px solid #ccc;
      border-radius: 1rem;
      background: rgb(255, 117, 117);
      /* background: rgb(15, 203, 181); */
      box-shadow: 3px 3px 10px #aaa;
      /* margin: 0 5px; */
      font-size: 10px;
    }

    .del:hover {
      background: #504d78;
      color: #fff;
    }
  </style>
</head>

<body>
  <!-- 上方選單 -->
  <nav>
    <?php include "./layout/header.php"; ?>
    <?php include "./layout/back_nav.php"; ?>
  </nav>

  <!-- 主要內容 -->
  <div class="container">
    <h1>投票管理中心</h1>

    <?php
    if (isset($_GET['do'])) { //如果有取得do這個頁面的話執行
      $file = "./back/" . $_GET['do'] . ".php"; //導向網址
    }

    if (isset($file) && file_exists($file)) { //判斷如果有檔案在載入
      include $file;
    } else {
    ?>
      <button class=btn onclick="location.href='?do=add_vote'">新增投票</button><!-- get傳值檔案名稱 -->

      <div>
        <ul>
          <li class="list-header">
            <div>類別：</div>
            <div>投票主題：</div>
            <div>單/複選題：</div>
            <div>投票期間：</div>
            <div>剩餘天數：</div>
            <div>投票人數：</div>
            <div>操作：</div>
          </li>
          <?php
          $subjects = show_table_contents('subjects'); //取得所有投票列表
          foreach ($subjects as $subject) { //使用迴圈印內容
            echo "<div class='subject_container'>";
            $sql_title = "select name from types where  `id`= '{$subject["type_id"]}'";
            $typename = $pdo->query($sql_title)->fetch(PDO::FETCH_ASSOC);
            echo "<div class='subject_li'>{$typename['name']}</div>";
            echo "<div class='subject_li_title'>{$subject['subject']}</div>"; //只取得欄位

            if ($subject['multiple'] == 0) {
              echo "<div class='subject_li'>單選題</div>";
            } else {
              echo "<div class='subject_li'>複選題</div>";
            }

            echo "<div class='subject_li'>"; //投票開始與結束時間
            echo $subject['start'] . "~" . $subject['end'];
            echo "</div>";

            echo "<div class='subject_li'>"; //投票剩餘天數
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

            echo "<div class='subject_li'>"; //操作區
            echo "<a class='edit' href='?do=edit&id={$subject['id']}'>編輯</a>";
            echo "<a class='del' href='?do=del&id={$subject['id']}'>刪除</a>";
            echo "<a class='chmod' href='?do=del&id={$subject['id']}'>開關</a>";
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

  <!-- 頁尾 -->
  <?php include "./layout/footer.php"; ?>
</body>

</html>