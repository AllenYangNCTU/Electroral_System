<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php
    include_once("./api/base.php");
    $results = show_table_contents("users");
    // dd($results);
    foreach ($results as $key => $result) {
        print("User #" . $key + 1 . "<br><br>");
        print("ID: " . $result['id'] . "<br>");
        print("Account: " . $result['acc'] . "<br>");
        print("Passwords: " . $result['pw'] . "<br>");
        print("Name: " . $result['name'] . "<br>");
        print("Birthday: " . $result['birthday'] . "<br>");
        print("Address: " . $result['addr'] . "<br>");
        print("E-mail: " . $result['email'] . "<br>");
        print("Passnote: " . $result['passnote'] . "<br>");
        print("會員等級: " . (($result['admin']) ? "管理員" : "一般會員") . "<br><br><br>");
    ?>
        <?php
        if (isset($_GET['do'])) { //如果有取得do這個頁面的話執行
            $file = "./back/" . $_GET['do'] . ".php"; //導向網址
        }

        if (isset($file) && file_exists($file)) { //判斷如果有檔案在載入
            include $file;
        } else if (!$result['admin']) {
        ?>

            <button class=btn onclick="location.href='./back/remove_account.php?do=remove_account&id=<?= $result['id']; ?>'">刪除使用者</button><!-- get傳值檔案名稱 -->
            <button class=btn onclick="location.href='./back/chmod.php?do=chmod&action=upgrade&id=<?= $result['id']; ?>'">提高等級</button>
            <br><!-- get傳值檔案名稱 -->
        <?php
        } else if ($result['acc'] != $_SESSION['user']) {
        ?>
            <button class=btn onclick="location.href='./back/chmod.php?do=chmod&action=downgrade&id=<?= $result['id']; ?>'">降低等級</button><!-- get傳值檔案名稱 -->
            <br>
        <?php } ?>

    <?php
    }

    ?>
</body>

</html>