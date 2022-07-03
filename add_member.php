<?php
include "./api/base.php"; //連線資料庫

$pw=md5($_POST['pw']);//把密碼用MP5顯示
$sql="INSERT INTO `users` (`acc`,`pw`,`name`,`birthday`,`addr`,`email`,`passnote`) 
                    values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['birthday']}','{$_POST['addr']}','{$_POST['email']}','{$_POST['passnote']}');";

$pdo->exec($sql);

header("location:login.php");

?>

