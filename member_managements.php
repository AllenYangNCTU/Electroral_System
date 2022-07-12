<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Management Center</title>
    <link rel="stylesheet" href="./css/back.css">
    <style>
        .subject_container_member {
            display: flex;
            justify-content: space-evenly;
        }

        .subject_container_member:hover {
            background-color: #fed6e3;
            transform: scale(1.05, 1.05);
            transition: all 0.5s ease-out;
            border-radius: 10px;
        }

        .subject_container_admin {
            display: flex;
            justify-content: space-evenly;
            background-color: #e5c667;
        }

        .subject_container_admin:hover {
            background-color: #fed6e3;
            transform: scale(1.05, 1.05);
            transition: all 0.5s ease-out;
            border-radius: 10px;
        }

        .subject_li {
            width: calc(100% / 9);
            display: inline-block;
            text-align: center;
            font-weight: bold;
            font-size: 15px;
        }

        .subject_li_title {
            width: calc(100% / 9);
            display: inline-block;
            text-align: left;
            font-weight: bold;
            font-size: 15px;
            padding-left: 3%;
        }

        .btn_manage {
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

        .list-header {
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <nav>
        <?php include "./layout/header.php"; ?>
        <?php include "./layout/back_nav.php"; ?>
    </nav>

    <h1>會員列表</h1>
    <div>
        <ul>
            <li class="list-header">
                <div>ID：</div>
                <div>Acccount：</div>
                <div>Name：</div>
                <div>Birthday：</div>
                <div>E-mail：</div>
                <div></div>
                <div>membership level：</div>
                <div>Delete user：</div>
                <div>Modify permissions：</div>
            </li>
            <?php
            include_once("./api/base.php");
            $results = show_table_contents("users");
            foreach ($results as $key => $result) {
                $member_class = (($result['admin']) ? "subject_container_admin" : "subject_container_member");
                echo "<div class=$member_class>";
            ?>
                <div class="subject_li"> <?php print("ID: " . $result['id']); ?></div>
                <div class="subject_li"> <?php print($result['acc']); ?></div>
                <div class="subject_li"> <?php print($result['name']); ?></div>
                <div class="subject_li"> <?php print($result['birthday']); ?></div>

                <div style="text-align:left;" class="subject_li"> <?php print($result['email']); ?></div>
                <div class="subject_li"></div>
                <div class="subject_li"> <?php print((($result['admin']) ? "admin" : "member")); ?></div>

                <?php
                if (isset($_GET['do'])) {
                    $file = "./back/" . $_GET['do'] . ".php";
                }

                if (isset($file) && file_exists($file)) {
                    include $file;
                } else if (!$result['admin']) {
                ?>
                    <div class="subject_li"><button class=btn_manage onclick="location.href='./back/remove_account.php?do=remove_account&id=<?= $result['id']; ?>'">刪使用者</button></div> <!-- get傳值檔案名稱 -->
                    <div class="subject_li"><button class=btn_manage onclick="location.href='./back/chmod.php?do=chmod&action=upgrade&id=<?= $result['id']; ?>'">提高等級</button></div>
                <?php
                } else if ($result['acc'] != $_SESSION['user']) {
                ?>
                    <div class="subject_li"><button class=btn_cannot_change>須先降級</button></div>
                    <div class="subject_li"><button class=btn_manage onclick="location.href='./back/chmod.php?do=chmod&action=downgrade&id=<?= $result['id']; ?>'">降低等級</button></div>
                <?php } else { ?>
                    <div class="subject_li"><button class=btn_cannot_change>不能刪除</button></div>
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
<?php include "./layout/footer.php"; ?>