<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/back.css">
    <style>
        .subject_container {
            display: flex;
            justify-content: space-evenly;
            /* float: left; */
        }

        .subject_li {
            width: calc(100% / 10);
            display: inline-block;
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            /* background-color: red; */
            /* margin-left: 4%; */
        }

        .subject_li_title {
            width: calc(100% / 10);
            display: inline-block;
            text-align: left;
            font-weight: bold;
            font-size: 15px;
            /* margin-left: 4%; */
            padding-left: 3%;
        }

        .btn_manage {
            /* margin-left: 5rem; */
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-image: linear-gradient(to top, #fed6e3 0%, #a8edea 100%, #fed6e3 0%, #a8edea 100%, #fed6e3 0%);
            padding: 0.25rem 0.25rem;
            font-size: 1.1rem;
            box-sizing: 0 0 10px #ccc;
            border: none;
            outline: none;

        }

        .btn_cannot_change {
            /* margin-left: 5rem; */
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-image: linear-gradient(to top, #fed6e3 0%, #a8edea 100%, #fed6e3 0%, #a8edea 100%, #fed6e3 0%);
            padding: 0.25rem 0.25rem;
            font-size: 1.1rem;
            box-sizing: 0 0 10px #ccc;
            border: none;
            outline: none;

        }

        .btn_manage:hover {
            cursor: pointer;
        }

        .btn_cannot_change:hover {
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <nav>
        <?php include "./layout/header.php"; ?>
        <?php include "./layout/back_nav.php"; ?>
    </nav>

    <h1>會員列表</h1>
    <!-- <a href="./member_center.php">返回</a><br><br><br> -->
    <div>
        <ul>
            <li class="list-header">
                <div>ID：</div>
                <div>Acccount：</div>
                <!-- <div>Passwords：</div> -->
                <div>Name：</div>
                <div>Birthday：</div>
                <div>Address：</div>
                <div>E-mail：</div>
                <!-- <div>Passnote：</div> -->
                <div></div>
                <div>會員等級：</div>
                <div>刪除使用者：</div>
                <div>權限調整：</div>
            </li>
            <?php
            include_once("./api/base.php");
            $results = show_table_contents("users");
            foreach ($results as $key => $result) {
                echo "<div class='subject_container'>";
                //  print("User #" . $key + 1);
            ?>

                <div class="subject_li"> <?php print("ID: " . $result['id']); ?></div>
                <div class="subject_li"> <?php print($result['acc']); ?></div>
                <div class="subject_li"> <?php print($result['name']); ?></div>
                <div class="subject_li"> <?php print($result['birthday']); ?></div>
                <div class="subject_li"> <?php print($result['addr']); ?></div>
                <div class="subject_li"> <?php print($result['email']); ?></div>
                <div class="subject_li"> <?php
                                            // print($result['passnote']); 
                                            ?></div>
                <div class="subject_li"> <?php print((($result['admin']) ? "管理員" : "一般會員")); ?></div>

                <?php
                if (isset($_GET['do'])) { //如果有取得do這個頁面的話執行
                    $file = "./back/" . $_GET['do'] . ".php"; //導向網址
                }

                if (isset($file) && file_exists($file)) { //判斷如果有檔案在載入
                    include $file;
                } else if (!$result['admin']) {
                ?>

                    <div class="subject_li"><button class=btn_manage onclick="location.href='./back/remove_account.php?do=remove_account&id=<?= $result['id']; ?>'">刪使用者</button></div> <!-- get傳值檔案名稱 -->
                    <div class="subject_li"><button class=btn_manage onclick="location.href='./back/chmod.php?do=chmod&action=upgrade&id=<?= $result['id']; ?>'">提高等級</button></div>

                <?php
                } else if ($result['acc'] != $_SESSION['user']) {
                ?>
                    <div class="subject_li"><button class=btn_cannot_change>須先降級</button></div> <!-- get傳值檔案名稱 -->
                    <div class="subject_li"><button class=btn_manage onclick="location.href='./back/chmod.php?do=chmod&action=downgrade&id=<?= $result['id']; ?>'">降低等級</button></div>
                <?php } else { ?>
                    <div class="subject_li"><button class=btn_cannot_change>不能刪除</button></div> <!-- get傳值檔案名稱 -->
                    <div class="subject_li"><button class=btn_cannot_change>不能更改</button></div>
            <?php
                }
                echo "</div>";
            }

            ?>

        </ul>
    </div>
    <a href="#">TOP</a>
</body>

</html>