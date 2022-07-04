<?php
include "./api/base.php"; //連線資料庫
if ($_POST['pw'] == $_POST['re_pw']) {


    $pw = md5($_POST['pw']); //把密碼用MP5顯示
    $sql = "INSERT INTO `users` (`acc`,`pw`,`name`,`birthday`,`addr`,`email`,`passnote`) 
                    values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['birthday']}','{$_POST['addr']}','{$_POST['email']}','{$_POST['passnote']}');";

    $pdo->exec($sql);

    header_to("./login.php");
} else {
    print("密碼前後不一致");
    header_to("./register_error.php");
}
